<?php

namespace App\Http\Controllers;
use Str;
use App\Farm;
use App\Payment;
use App\walletChange;
use App\SiteSetting;
use App\ConsultantSetting;
use App\Http\Requests\UpgradeRequest;
use App\LandCart;
use App\LandForSale;
use App\Mail\YourLandPurchaseIsSuccessfulOnFarmaax;
use App\Mail\NewLandPurchase;
use App\FarmManager;
use App\Mail\AUserHasSetUpAFarm;
use App\Mail\FarmSetupIsSucessful;
use App\MyFarmSetup;
use App\MyLand;
use App\User;
use App\Order;
use App\Cart;
use App\Product;
use App\Shipping;
use App\Investment;
use Session;
use App\Wallet;
use App\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Investment_cart;
use App\MyFarmInvestment;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function RecordWalletChange($user_id, $type, $amount, $statement){
         $wallet_change = new walletChange();

        $wallet_change->type = $type;
        $wallet_change->amount = $amount;
        $wallet_change->statement = $statement;
        $wallet_change->wallet_owner = $user_id;

        $wallet_change->save();
        return $wallet_change;
    }

    public function updateWalletChange($wallet_id, $status){

        $wallet_change = walletChange::where('id', $wallet_id)->first();

        $wallet_change->status = 'success';
        $wallet_change->save();
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
        $price = ($land->price/$land->acres) * $request->quantityOfAcres;
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

            $reference = time().Str::random(3);

            $payment = new Payment;

            $payment->user_id = Auth::user()->id;
            $payment->amount = $price;
            $payment->description = 'Land Purchase';
            $payment->status = 'pending';
            $payment->reference = $reference;

            $payment->save();

            $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'amount' => $amount,
                    'email' => $email,
                    'callback_url' => $callback_url,
                    'metadata' =>['land'=>$land, 'reference'=>$reference],
                   
                ]),
                CURLOPT_HTTPHEADER => [
                    "authorization: Bearer ".$apiKey, //replace this with your own test key
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

    public function landCartPay(Request $request, $id)

    {
        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
        // dd($request);

        $land = LandForSale::find($id);

        if ($request->units > ($land->acres-$land->purchased)) {
            return redirect()->back()->with('error', 'Sorry, only '.($land->acres-$land->purchased).' acres are available now');
        }

        $land['quantityOfAcres'] = $request->units;
        $price = ($land->price/$land->acres) * $request->units;

        // dd((int)$request->amount);
        if ((int)$price!=(int)$request->amount) {
            return redirect()->back()->with('error', 'Sorry, the price of this land has changed. Reload page to get current price');
        }
        $findCartItem = LandCart::where(['user_id' => Auth::id(), 'land_id'  => $id])->first();
        /*if ($findCartItem) {
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
        }*/
        
            $checkUserWallet = Auth::user()->wallet_balance;
            if ($checkUserWallet < $price) {
                


                $curl = curl_init();
                $email = Auth::user()->email;
                $amount = $price . '00';  //the amount in kobo. This value is actually NGN 300
                // url to go to after payment
                $callback_url = route('verifyLandPayment');

                $reference = time().Str::random(3);

                $payment = new Payment;

                $payment->user_id = Auth::user()->id;
                $payment->amount = $price;
                $payment->description = 'Land Purchase';
                $payment->status = 'pending';
                $payment->reference = $reference;

                $payment->save();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode([
                        'amount' => $amount,
                        'email' => $email,
                        'callback_url' => $callback_url,
                        'metadata' =>['land'=>$land, 'reference'=>$reference],
                       
                    ]),
                    CURLOPT_HTTPHEADER => [
                        "authorization: Bearer ".$apiKey, //replace this with your own test key
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
            else {

                // record wallet debit in wallet debit history

               $walletRecord=$this->RecordWalletChange(Auth::user()->id, 'debit', $price, 'Land Purchase');
               // dd($walletRecord);
                // debit user wallet
                $user = User::where('id', Auth::user()->id)->first();
                $user->wallet_balance = $user->wallet_balance - $price;
                $user->save();

                // update wallet debit record to success

                $this->updateWalletChange($walletRecord->id, 'success');
                

                $my_land = new MyLand;
                $my_land->user_id = Auth::id();
                $my_land->land_id =  $land->id;
                $my_land->price = $price;

                $my_land->save();

               
                $updateLandDetails = LandForSale::findOrFail($land->id);
                $updateLandDetails->purchase_date = now();
                // $updateLandDetails->buyer_id = Auth::id();
                // $updateLandDetails->status = 'sold';
                if ($land->acres==($updateLandDetails->purchased + $request->units)) {
                    $updateLandDetails->status = 'sold';
                }
                $updateLandDetails->purchased = $updateLandDetails->purchased + $request->units;
                
                $updateLandDetails->save();

                LandCart::where('id', $request->cart_id)->delete();

                /*Mail::to(Auth::user()->email)->send(new YourLandPurchaseIsSuccessfulOnFarmaax($updateLandDetails));
                Mail::to(env('MAIL_USERNAME'))->send(new NewLandPurchase($updateLandDetails));*/
                
                return redirect(url('my-lands'))->with('success', 'Your land Purchase is successful');
            }
    }

    public function verifyLandPayment()
    {
        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
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
                "authorization: Bearer ".$apiKey,
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

            // dd($tranx['data']);
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value
            $payment = Payment::where('reference' , $tranx['data']['metadata']['reference'])->first();
            
            $payment->status = 'success';

            $payment->save();


            $my_land = new MyLand;
            $my_land->user_id = Auth::id();
            $my_land->land_id =  $tranx['data']['metadata']['land']['id'];
            $my_land->coverImage = $tranx['data']['metadata']['land']['coverImage'];
            $my_land->price = $tranx['data']['metadata']['land']['price'];
            $my_land->landTitle = $tranx['data']['metadata']['land']['landTitle'];
            $my_land->state = $tranx['data']['metadata']['land']['state'];
            $my_land->address = $tranx['data']['metadata']['land']['address'];
            $my_land->lga = $tranx['data']['metadata']['land']['lga'];
            $my_land->town = $tranx['data']['metadata']['land']['town'];
            $my_land->size = $tranx['data']['metadata']['land']['quantityOfAcres'];

            $my_land->save();

           
            $updateLandDetails = LandForSale::findOrFail($tranx['data']['metadata']['land']['id']);
            $updateLandDetails->purchase_date = now();
            $updateLandDetails->buyer_id = Auth::id();
            $updateLandDetails->purchased = $updateLandDetails->purchased + $tranx['data']['metadata']['land']['quantityOfAcres'];

            // $updateLandDetails->status = 'sold';
            $updateLandDetails->save();


            if ($updateLandDetails->purchased>=$updateLandDetails->acres) {
                $updateLandDetails->status = 'sold';
                $updateLandDetails->save();
            }

            $amount = $tranx['data']['amount']/100;


            $this->creditCommisions($amount, 'land_purchase');


            /*Mail::to(Auth::user()->email)->send(new YourLandPurchaseIsSuccessfulOnFarmaax($updateLandDetails));
            Mail::to(env('MAIL_USERNAME'))->send(new NewLandPurchase($updateLandDetails));*/
            if (Session::has(['takeToFarmLandCheckout'])) {
                return redirect(route('continueToCheckOut'))->with('success', 'You have successfully purchased a land from Farmaax. Please proceed with your farm setup ');
            }
            return redirect(route('myLands'))->with('success', 'Your land Purchase is successful');
            // return redirect(route('fundWallet'))->with('success', 'Please fund your wallet to proceed. You have only ' . number_format(Auth::user()->wallet_balance));
        }
    }

    public function upgradeAccount()
    {
        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
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
                'callback_url' => $callback_url
                // "metadata" => $data
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer ".$apiKey, //replace this with your own test key
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

     public function consultantRegFee()
    {
        // $data =  $request->validated();
        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
        $curl = curl_init();
        $email = Auth::user()->email;
         $consultantSetting = SiteSetting::first();  //the amount in kobo. This value is actually NGN 300
        $amount=100*$consultantSetting->consultant_signup_fee;
        $reference =time().Str::random(3);
        $payment = new Payment;

        $payment->user_id = Auth::user()->id;
        $payment->amount = $amount/100;
        $payment->description = 'Account Upgrade';
        $payment->status = 'pending';
        $payment->reference = $reference;

        $payment->save();
                
        // url to go to after payment
        $callback_url = route('verify.upgrade.account.payment');

        $opt_arr = is_null(session('options')) ? session('farmtype'): session('options');

        

        $opt_arr['reference']=$reference;
        // array_unshift($opt_arr, $reference);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => $email,
                'callback_url' => $callback_url,
                "metadata" => $opt_arr,
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer ".$apiKey, //replace this with your own test key
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
        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
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
                "authorization: Bearer ".$apiKey,
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

            $payment = Payment::where('reference', $tranx['data']['metadata']['reference'])->first();

            $payment->status = 'success';
            $payment->save();
            // transaction was successful...
            // please check other things like whether you already gave value for this ref
            // if the email matches the customer who owns the product etc
            // Give value
            // $upgradeUserAccount  = User::findOrFail(Auth::id());
            // $upg
            $upgradeUserAccount  = User::findOrFail(Auth::id());

            if(!is_null(session('options'))){
                // $metaCount=1;

                // dd($tranx['data']['metadata']);

                foreach ($tranx['data']['metadata'] as  $key=>$value) {
                    if ($key!='reference') {
                        $upgradeUserAccount->$key = $key;
                        $upgradeUserAccount->save();
                    }
                    

                    // $metaCount++;

                }

                session()->forget('option');
            }

          $this->creditParentBonus($tranx['data']['amount']/100, 'consultant_referral_bonus');

            return redirect(url('dashboard'))->with('success', 'Account upgrade successful');
        }
    }

    public function initializeFarmSetupPayment(Request $request){

        // $data =  $request->validated();

        $curl = curl_init();
        $email = Auth::user()->email;
        $amount=100*$request->total_amount;
        $reference =time().Str::random(3);
        $payment = new Payment;

        $payment->user_id = Auth::user()->id;
        $payment->amount = $amount/100;
        $payment->description = 'Farm Setup';
        $payment->status = 'pending';
        $payment->reference = $reference;

        $payment->save();
                
        // url to go to after payment
        $callback_url = url('verify_farmsetup_payment');

        $key = SiteSetting::where('id', 1)->first()->paystack_key;

        // $opt_arr = is_null(session('options')) ? session('farmtype'): session('options');

        

        $opt_arr['reference']=$reference;
        $opt_arr['farm_id']=$request->farm_id;
        // array_unshift($opt_arr, $reference);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => $email,
                'callback_url' => $callback_url,
                "metadata" => $opt_arr,
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer ".$key, //replace this with your own test key
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
        // print_r($tranx);
        // redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page
        return redirect($tranx['data']['authorization_url']);
    
    }

    public function verifyFarmSetUpPayment(){

        $key = SiteSetting::where('id', 1)->first()->paystack_key;
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
                "authorization: Bearer ".$key,
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

            // dd($tranx['data']);

            $payment = Payment::where('reference', $tranx['data']['metadata']['reference'])->first();

            $payment->status = 'success';
            $payment->save();

            $myFarmSetup = MyFarmSetup::where('id', $tranx['data']['metadata']['farm_id'])->first();

            $myFarmSetup->status = 'paid';

            $myFarmSetup->save();

            $land = LandForSale::where('id', $myFarmSetup->land_id)->first();
            if (!is_null($land)) {
               $land->purchased = $land->purchased + $myFarmSetup->size;

                $land->save();
            }

            $this->creditCommisions($payment->amount, 'farm_setup');

        

            return redirect(url('dashboard'))->with('success', 'Congrats! Farm Setup Completed');;
        }
    }

    public function initializeWalletFunding(Request $request)
    {
        $data =  $request->validate([
            'amount' => 'required'
        ]);

        $curl = curl_init();
        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
        $email = Auth::user()->email;
        $amount = $request->amount . '00';  //the amount in kobo. This value is actually NGN 300
        // url to go to after payment
        $callback_url = route('verifyWalletFunding');

        $reference = time().Str::random(3);

        $payment = new Payment;

        $payment->user_id = Auth::user()->id;
        $payment->amount = $request->amount;
        $payment->description = 'Wallet Funding';
        $payment->status = 'pending';
        $payment->reference = $reference;
        $data['reference'] = $reference;

        $payment->save();

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
                "authorization: Bearer ".$apiKey, //replace this with your own test key
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
        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
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
                "authorization: Bearer ".$apiKey,
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
            $payment = Payment::where('reference', $tranx['data']['metadata']['reference'])->first();

            
            $payment->status = 'success';
            $payment->reference = $reference;

            $payment->save();

            /*Payment::create([
                'user_id' => Auth::id(),
                'amount' => $tranx['data']['metadata']['amount'],
                'description' => 'Funded my wallet'
            ]);*/
            $user_wallet = User::findOrFail(Auth::id());
            $user_wallet->wallet_balance += $tranx['data']['metadata']['amount'];
            $user_wallet->save();

            if (session('previous_page')) {

                return redirect(url(session('previous_page')))->with('success', 'wallet funded Successfully. proceed to payment');
            }else{
                return redirect(route('home'))->with('success', 'Your wallet has been funded Successfully');
            }
            
        }
    }

    public function farmSetUpCheckout(Request $request)
    {

        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
        if ($request->paymentMethod == 'wallet') {
            $checkUserWallet = Auth::user()->wallet_balance;
            if ($checkUserWallet < $request->amount) {
                return redirect(route('fundWallet'))->with('error', 'Sorry, your wallet Balance is insufficient for the farm setup you selected. Fund your wallet or choose Bank Debit option when selecting payment method');
            } else {
                $lastDetails = Session::get('lastDetails');
                $data  = Session::get('farmDetails');
                // dd($lastDetails)
                // $data['amount_paid'] =  $tranx['data']['amount'];
                Payment::create([
                    'user_id' => Auth::id(),
                    'amount' => $request->amount,
                    'description' => 'You set up a ' . $data['nameOfFarm'],
                ]);
                MyFarmSetup::create([
                    'owner_id' => Auth::id(),
                    'farm_id' => $data['idOfFarm']
                ]);
                $getFarm =     Farm::where('farm_type', $data['idOfFarm'])->firstOrFail();
                $getFarm->owner_id = Auth::id();
                $getFarm->total_units -= $lastDetails['acre'];
                $getFarm->save();
                Mail::to(Auth::user()->email)->send(new FarmSetupIsSucessful($lastDetails, $data));
                Mail::to(env('MAIL_USERNAME'))->send(new AUserHasSetUpAFarm($lastDetails, $data));
                return redirect(route('home'))->with('success', 'Your Farm Setup is successful. We will get in touch with you as soon as possible');
            }
        } else {
            $curl = curl_init();
            $email = Auth::user()->email;
            $amount = $request->amount . '00';  //the amount in kobo. This value is actually NGN 300
            // url to go to after payment
            $callback_url = route('verifyfarmSetUpPayment');

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    'amount' => $amount,
                    'email' => $email,
                    'callback_url' => $callback_url,
                    // 'metadata' => $land,
                ]),
                CURLOPT_HTTPHEADER => [
                    "authorization: Bearer ".$apiKey, //replace this with your own test key
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
    public function verifyfarmSetUpCheckout()
    {
        $apiKey = SiteSetting::where('id', 1)->first()->paystack_key;
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
                "authorization: Bearer ".$apiKey,
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
            // dd($tranx);
            $lastDetails = Session::get('lastDetails');
            $data  = Session::get('farmDetails');
            // dd($lastDetails)
            $data['amount_paid'] =  $tranx['data']['amount'];
            Payment::create([
                'user_id' => Auth::id(),
                'amount' => $tranx['data']['amount'],
                'description' => 'You set up a ' . $data['nameOfFarm'],
            ]);
            MyFarmSetup::create([
                'owner_id' => Auth::id(),
                'farm_id' => $data['idOfFarm']
            ]);
            $getFarm =     Farm::where('farm_type', $data['idOfFarm'])->firstOrFail();
            $getFarm->owner_id = Auth::id();
            $getFarm->total_units -= $lastDetails['acre'];
            $getFarm->save();
            Mail::to(Auth::user()->email)->send(new FarmSetupIsSucessful($lastDetails, $data));
            Mail::to(env('MAIL_USERNAME'))->send(new AUserHasSetUpAFarm($lastDetails, $data));
            return redirect(route('home'))->with('success', 'Your Farm Setup is successful. We will get in touch with you as soon as possible');
            // return redirect(route('fundWallet'))->with('success', 'Please fund your wallet to proceed. You have only ' . number_format(Auth::user()->wallet_balance));
        }
    }

     public function creditCommisions($amount, $description){
        $this->creditParentBonus($amount, $description.'_parent_commission');

        $this->creditGrandParentBonus($amount, $description.'_grand_parent_commission');

        $this->creditGreatGrandParentBonus($amount, $description.'_great_grand_parent_commission');
     }



    public function creditParentBonus($amount, $description){

        $walletBonus = 0.05*$amount;

        $staticBonus = 0.02*$amount;

        $user = User::where('id', Auth::user()->id)->first();
        if ((int)$user->parent>0) {
            
            $this->recordEarning($walletBonus,  $user->parent, $description);

            $this->recordEarning($staticBonus,  $user->parent, 'static_'.$description);

            $parent = User::where('id', $user->parent)->first();
            if (!is_null($parent)) {
               $parent->wallet_balance = $parent->wallet_balance + $walletBonus;

                $parent->static_wallet_balance = $parent->static_wallet_balance + $staticBonus;

                $parent->save();
            }
        }


    }

    

    public function creditGrandParentBonus($amount, $description){

        $walletBonus = 0.02 * $amount;
        
        $user = User::where('id', Auth::user()->id)->first();

        if ((int)$user->parent>0) {

            $parent =  User::where('id', $user->parent)->first();
            if ((int)$parent->parent>0) {
                $grandParent = User::where('id', $parent->parent)->first();

                $this->recordEarning($walletBonus,  $grandParent->id, $description);

                $grandParent->wallet_balance = $grandParent->wallet_balance + $walletBonus;

                $grandParent->save();
            }
            
        }
    }


    public function creditGreatGrandParentBonus($amount, $description){

        $walletBonus = 0.01 * $amount;
        
        $user = User::where('id', Auth::user()->id)->first();

        if ((int)$user->parent>0) {

            $parent =  User::where('id', $user->parent)->first();

            if (!is_null($parent)) {
                $grandParent = User::where('id', $parent->parent)->first();
            }

            if (!is_null($grandParent)) {
               $greatGrandParent = User::where('id', $grandParent->parent)->first();
            }

            if (!is_null($greatGrandParent)) {
               $this->recordEarning($walletBonus,  $greatGrandParent->id, $description);

                $greatGrandParent->wallet_balance = $greatGrandParent->wallet_balance + $walletBonus;

                 $greatGrandParent->save();
            }

        }
        
        
    }


    public function recordEarning($amount, $userId, $description){

        $earning = new Earning;

        $earning->amount = $amount;

        $earning->user_id = $userId;

        $earning->description = $description;

        $earning->save();
    }



    public function initializeStoreOrderPayment(){

        // dd(session('paymentData'));

        $myData = session('paymentData');


        // $data =  $request->validated();
        $curl = curl_init();
        $email = Auth::user()->email;
         // $consultantSetting = ConsultantSetting::where('id', 1)->first();  //the amount in kobo. This value is actually NGN 300
        $amount=100* $myData['checkoutData']['grandtotal'];
        $reference = $myData['reference'];
        $payment = new Payment;

        $payment->user_id = Auth::user()->id;
        $payment->amount = $amount/100;
        $payment->description = 'Store Purchase';
        $payment->status = 'pending';
        $payment->reference = $reference;

        $payment->save();
                
        // url to go to after payment
        $callback_url = route('verify-store-payment');

        $key = SiteSetting::where('id', 1)->first()->paystack_key;

        // $opt_arr = is_null(session('options')) ? session('farmtype'): session('options');

        

        // $opt_arr['reference']=$reference;
        // $opt_arr['farm_id']=$request->farm_id;
        // array_unshift($opt_arr, $reference);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $amount,
                'email' => $email,
                'callback_url' => $callback_url,
                "metadata" => $myData,
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer ".$key, //replace this with your own test key
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
        // print_r($tranx);
        // redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page

        session()->forget('paymentData');

        session()->forget('orderData');

        return redirect($tranx['data']['authorization_url']);
    
    }

    public function verifyStoreOrderPayment(){

        $key = SiteSetting::where('id', 1)->first()->paystack_key;
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
                "authorization: Bearer ".$key,
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

            // dd($tranx['data']);
            // Update payment staus

            $payment = Payment::where('reference', $tranx['data']['metadata']['reference'])->first();

            $payment->status = 'success';
            $payment->save();


            // record order in DB
            $myorder = new Order;

            $myorder->status = 'paid';
            $myorder->reference = $tranx['data']['metadata']['reference'];
            $myorder->products = json_encode($tranx['data']['metadata']['products']);
            $myorder->amount = $tranx['data']['metadata']['checkoutData']['subtotal'];
            $myorder->shipping_address = $tranx['data']['metadata']['checkoutData']['delivery_address'];

            $myorder->user_id = Auth::user()->id;

            $myorder->save();

            // record shipping Cost

            $shipping_cost = $tranx['data']['metadata']['checkoutData']['grandtotal'] - $tranx['data']['metadata']['checkoutData']['subtotal'];

            $this->storeShippingCost($tranx['data']['metadata']['reference'], $shipping_cost);


            // empty user's cart
            $emptyCart = Cart::where('guest_id', $_COOKIE['guest'])->delete();

            // Update Product Quanitied


            foreach ($tranx['data']['metadata']['products'] as $product) {
               $this->subtractProductQuatity($product['product_id'], $product['quantity']);
            }

            // dd('payment success');
            session(['payment_summary'=>$tranx['data']['metadata']]);
            return redirect(route('store-payment-success', $tranx['data']['metadata']['reference']));
        }
    }


    public function storeShippingCost($orderRef, $shippingCost){
        $order = Order::where('reference', $orderRef)->first();
        $shipping = new Shipping;

        $shipping->order_ref = $orderRef;

        $shipping->payment_status = $order->status;

        $shipping->address = $order->shipping_address;

        $shipping->cost = $shippingCost;

        $shipping->save();

    }

    public function subtractProductQuatity($productId, $decreaseValue){
        $product = Product::where('id', $productId)->first();

        $product->quantity = $product->quantity - $decreaseValue;

        $product->save();
    }


    public function makeInvestment(Request $request, $cart_id = null)
    {
        // dd($request->units);
        $user = User::where('id', Auth::user()->id)->first();

        $amount = $request->amount;

        if ($user->wallet_balance >= $amount) {

            $farm_id = $request->farm_id;
            // $selected_units=$request->selected_units;

            $investment = new Investment;

            $farm = Farm::where('id', $farm_id)->first();
            $available_units = (int)$farm->total_units - (int)$farm->units_taken;

            $investment->user_id = $user->id;
            $investment->farm_id = $request->farm_id;

            if ($request->units <= $available_units) {

                $user->wallet_balance = $user->wallet_balance - $amount;

                $investment = new Investment;

                $investment->user_id = $user->id;
                $investment->farm_id = $request->farm_id;
                $investment->amount_paid = $request->amount;
                $investment->units = $request->units;
                $farm->units_taken = (int)$farm->units_taken + (int)$request->units;
                $farm->save();
                $investment->save();
                $user->save();

                $myFarmInvestment = new MyFarmInvestment;

                $myFarmInvestment->user_id = Auth::user()->id;
                $myFarmInvestment->farm_id = $investment->farm_id;

                $myFarmInvestment->units = $request->units;
                $myFarmInvestment->save();

                $this->creditCommisions($amount, 'investment_farming');
                // MyFarmInvestment::create([
                //     'user_id' => Auth::id(),
                //     'farm_id' => $investment->farm_id
                // ]);



                if ($cart_id != null) {
                    Investment_cart::where('id', $cart_id)->delete();
                }
                return redirect('dashboard')->with('success',  'payment received. Congrats! you are now an investor');
            } else {

                return redirect('farms')->with('error',  'only ' . $farm->$available_units . ' available');
            }
        } else {
            $cart = new Investment_cart;

            $cart->user_id = $user->id;
            $cart->farm_id = $request->farm_id;
            $cart->amount_paid = $request->amount;
            $cart->units = $request->units;
            $cart->save();

            Session(['previous_page'=>'farmcart']);


            return redirect(route('fundWallet'))->with('error', 'fund wallet to proceed');
        }


    }
}
