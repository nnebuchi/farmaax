<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpgradeRequest;
use App\LandCart;
use App\LandForSale;
use App\Mail\YourLandPurchaseIsSuccessfulOnFarmaax;
use App\Mail\NewLandPurchase;
use App\MyLand;
use App\Payment;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function land(Request $request, $id)
    {
        $data =  $request->validate([
            'paymentMethod' => 'required',
            'quantityOfAcres' => 'required'
        ]);

        $land = LandForSale::find($id);
        if ($request->quantityOfAcres > $land->acres) {
            return redirect()->back()->with('error', 'Sorry, The quantity of acres you selected is greater than the available acres');
        }
        $land['quantityOfAcres'] = $request->quantityOfAcres;
        $price = $land->price * $request->quantityOfAcres;
        $findCartItem = LandCart::where(['user_id' => Auth::id(), 'land_id'  => $id])->first();
        if ($findCartItem) {
            $findCartItem->amount += $land->price * $request->quantityOfAcres;
            $findCartItem->acres += $request->quantityOfAcres;
            $findCartItem->save();
        } else {
            $newLandCart = new LandCart();
            $newLandCart->user_id = Auth::id();
            $newLandCart->amount = $land->price * $request->quantityOfAcres;
            $newLandCart->land_id = $land->id;
            $newLandCart->acres = $request->quantityOfAcres;
            $newLandCart->save();
        }
        if ($request->paymentMethod == 'wallet') {
            $checkUserWallet = Auth::user()->wallet_balance;
            if ($checkUserWallet < $price) {
                return redirect()->back()->with('error', 'Sorry, your wallet Balance is insufficient for the land you want to purchase. Fund your wallet or choose Bank Debit option when selecting payment method');
            }
        } else {
            $curl = curl_init();
            $email = Auth::user()->email;
            $amount = $price . '00';  //the amount in kobo. This value is actually NGN 300
            // url to go to after payment
            $callback_url = route('verifyLandPayment');

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'amount' => $amount,
                    'email' => $email,
                    'callback_url' => $callback_url,
                    'metadata' => $land,
                ]),
                CURLOPT_HTTPHEADER => [
                    "authorization: Bearer sk_test_2a7ecb20756b0bdc06aab3cf50038b99d3b3e4d7", //replace this with your own test key
                    "content-type: application/json",
                    "cache-control: no-cache"
                ],
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            if ($err) {
                // there was an error contacting the Paystack API
                die('Curl returned error: ' . $err);
            }

            $tranx = json_decode($response, true);
            if (!$tranx['status']) {
                // there was an error from the API
                print_r('API returned error: ' . $tranx['message']);
            }

            // comment out this line if you want to redirect the user to the payment page
            print_r($tranx);
            // redirect to page so User can pay
            // uncomment this line to allow the user redirect to the payment page
            return redirect($tranx['data']['authorization_url']);
        }
    }
    public function verifyLandPayment()
    {
        $curl = curl_init();
        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        if (!$reference) {
            die('No reference supplied');
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer sk_test_2a7ecb20756b0bdc06aab3cf50038b99d3b3e4d7",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response, true);
        if (!$tranx['status']) {
            // there was an error from the API
            die('API returned error: ' . $tranx->message);
        }

        if ('success' == $tranx['data']['status']) {
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value

            MyLand::create([
                'user_id' => Auth::id(),
                'land_id' =>  $tranx['data']['metadata']['id'],
                'coverImage' => $tranx['data']['metadata']['coverImage'],
                'price' => $tranx['data']['metadata']['price'],
                'landTitle' => $tranx['data']['metadata']['landTitle'],
                'state' => $tranx['data']['metadata']['state'],
                'address' => $tranx['data']['metadata']['address'],
                'lga' => $tranx['data']['metadata']['lga'],
                'town' => $tranx['data']['metadata']['town'],

            ]);
            Payment::create([
                'user_id' => Auth::id(),
                'amount' => $tranx['data']['metadata']['price'],
                'description' => 'Bought a land'
            ]);
            $updateLandDetails = LandForSale::findOrFail($tranx['data']['metadata']['id']);
            $updateLandDetails->purchase_date = now();
            $updateLandDetails->buyer_id = Auth::id();
            $updateLandDetails->status = 'sold';
            $updateLandDetails->acres -= $tranx['data']['metadata']['quantityOfAcres'];
            $updateLandDetails->save();
            Mail::to(Auth::user()->email)->send(new YourLandPurchaseIsSuccessfulOnFarmaax($updateLandDetails));
            Mail::to(env('MAIL_USERNAME'))->send(new NewLandPurchase($updateLandDetails));
            return redirect(route('home'))->with('success', 'Your land Purchase is successful');
            // return redirect(route('fundWallet'))->with('success', 'Please fund your wallet to proceed. You have only ' . number_format(Auth::user()->wallet_balance));
        }
    }

    public function upgradeAccount(UpgradeRequest $request)
    {
        $data =  $request->validated();

        $curl = curl_init();
        $email = Auth::user()->email;
        $amount = 500000;  //the amount in kobo. This value is actually NGN 300
        // url to go to after payment
        $callback_url = route('verify.upgrade.account.payment');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => $email,
                'callback_url' => $callback_url,
                "metadata" => $data
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer sk_test_2a7ecb20756b0bdc06aab3cf50038b99d3b3e4d7", //replace this with your own test key
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response, true);
        if (!$tranx['status']) {
            // there was an error from the API
            print_r('API returned error: ' . $tranx['message']);
        }

        // comment out this line if you want to redirect the user to the payment page
        print_r($tranx);
        // redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page
        return redirect($tranx['data']['authorization_url']);
    }
    public function verifyUpgradeAccountPayment()
    {
        $curl = curl_init();
        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        if (!$reference) {
            die('No reference supplied');
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer sk_test_2a7ecb20756b0bdc06aab3cf50038b99d3b3e4d7",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response, true);
        // dd($tranx);
        // dd($tranx);
        if (!$tranx['status']) {
            // there was an error from the API
            die('API returned error: ' . $tranx->message);
        }

        if ('success' == $tranx['data']['status']) {
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value
            // $upgradeUserAccount  = User::findOrFail(Auth::id());
            // $upg
            $upgradeUserAccount  = User::findOrFail(Auth::id());
            foreach ($tranx['data']['metadata']['name'] as  $key) {
                $upgradeUserAccount->$key = 'yes';
                $upgradeUserAccount->save();
            }   
               $manager = new FarmManager();
               foreach ($tranx['data']['metadata']['name'] as  $key) {
                $manager->$key = 'yes';
                $manager->save();
            }
            Payment::create([
                'user_id' => Auth::id(),
                'amount' => 5000,
                'description' => 'Upgraded his account'
            ]);

            return redirect(route('home'))->with('success', 'Your Account has been Upgraded Successfully');
        }
    }
    public function initializeWalletFunding(Request $request)
    {
        $data =  $request->validate([
            'amount' => 'required'
        ]);

        $curl = curl_init();
        $email = Auth::user()->email;
        $amount = $request->amount . '00';  //the amount in kobo. This value is actually NGN 300
        // url to go to after payment
        $callback_url = route('verifyWalletFunding');

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => $email,
                'callback_url' => $callback_url,
                "metadata" => $data
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer sk_test_2a7ecb20756b0bdc06aab3cf50038b99d3b3e4d7", //replace this with your own test key
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response, true);
        if (!$tranx['status']) {
            // there was an error from the API
            print_r('API returned error: ' . $tranx['message']);
        }

        // comment out this line if you want to redirect the user to the payment page
        print_r($tranx);
        // redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page
        return redirect($tranx['data']['authorization_url']);
    }
    public function verifyWalletFunding()
    {
        $curl = curl_init();
        $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
        if (!$reference) {
            die('No reference supplied');
        }

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer sk_test_2a7ecb20756b0bdc06aab3cf50038b99d3b3e4d7",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if ($err) {
            // there was an error contacting the Paystack API
            die('Curl returned error: ' . $err);
        }

        $tranx = json_decode($response, true);
        // dd($tranx);

        if (!$tranx['status']) {
            // there was an error from the API
            die('API returned error: ' . $tranx->message);
        }

        if ('success' == $tranx['data']['status']) {
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value


            Payment::create([
                'user_id' => Auth::id(),
                'amount' => $tranx['data']['metadata']['amount'],
                'description' => 'Funded my wallet'
            ]);
            $user_wallet = User::findOrFail(Auth::id());
            $user_wallet->wallet_balance += $tranx['data']['metadata']['amount'];
            $user_wallet->save();

            return redirect(route('home'))->with('success', 'Your wallet has been funded Successfully');
        }
    }
}
