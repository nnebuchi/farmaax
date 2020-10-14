<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpgradeRequest;
use App\User;
use App\Investment;
use App\Investment_cart;
use App\MyFarmInvestment;
use App\Category;
use App\Farm;
use App\LandCart;
use App\LandForSale;
use App\MyLand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    //
    public function upgrade()
    {
        if (Auth::user()->account_name == null) {
            return view('users.updateaccount')->with('error', 'Please Add your Account Details to be able to Upgrade your Account');
        }
        return view('users.upgrade-account')->with('farmType', Category::get('name'));
    }
    public function storeBankAccountDetails(Request $request)
    {
        $data =  $request->validate([
            'account_name' => 'required|string',
            'account_number' => 'required',
            'bank_name' => 'required|string'
        ]);
        $user = User::findOrFail(Auth::id());
        $user->account_name = $data['account_name'];
        $user->account_number = $data['account_number'];
        $user->bank_name = $data['bank_name'];
        $user->save();
        return redirect()->intended('/dashboard')->with('success', 'Your Bank Details has been added Successfully');
    }
    public function showFundingWalletView()
    {
        if (Auth::user()->account_name == null) {
          
            return view('users.updateaccount')->with('error', 'Please Add your Account Details to enable you fund wallet');
        }
        return view('users.fund-wallet');
    }
    public function showMyLandsForSale()
    {
        return view('lands.mylands-for-sale')->with('lands', LandForSale::where('seller_id', Auth::id())->paginate(10));
    }
    public function farmsInvestedIn()
    {
        return view('farms.farmsInvestedIn')->with('farms', Farm::where('seller_id', Auth::id())->paginate(10));

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
                $farm->total_units = $farm->total_units - $request->units;
                $farm->save();
                $investment->save();
                $user->save();
                MyFarmInvestment::create([
                    'user_id' => Auth::id(),
                    'farm_id' => $investment->farm_id
                ]);



                if ($cart_id != null) {
                    Investment_cart::where('id', $cart_id)->delete();
                }
                return redirect('dashboard');
            } else {
               
                return redirect('farms')->with('error',  'only ' . $farm->$available_units . ' available');;
            }
        } else {
            $cart = new Investment_cart;

            $cart->user_id = $user->id;
            $cart->farm_id = $request->farm_id;
            $cart->amount_paid = $request->amount;
            $cart->units = $request->units;
            $cart->save();

           
            return redirect(route('fundWallet'))->with('error', 'fund wallet to proceed');
        }




        // // dd($request->units);
        // $user = User::where('id', Auth::user()->id)->first();
        // $amount = $request->amount;
        // if ($user->wallet_balance >= $amount) {

        //     $farm_id = $request->farm_id;
        //     // $selected_units=$request->selected_units;

        //     // $investment = new Investment;
        //     $farm = Farm::where('id', $farm_id)->first();
        //     $available_units = (int)$farm->total_units - (int)$farm->units_taken;

        //     // $investment->user_id = $user->id;
        //     // $investment->farm_id = $request->farm_id;

        //     if ($request->units <= $available_units) {

        //         $user->wallet_balance = $user->wallet_balance - $amount;

        //         $investment = new Investment;

        //         $investment->user_id = $user->id;
        //         $investment->farm_id = $request->farm_id;
        //         $investment->amount_paid = $request->amount;
        //         $investment->units = $request->units;
        //         $farm->total_units = $farm->total_units - $request->units;
        //         $farm->save();
        //         $investment->save();
        //         $user->save();

        //         if ($cart_id != null) {
        //             Investment_cart::where('id', $cart_id)->delete();
        //         }
        //         return redirect('dashboard');
        //     } else {
        //         Session(['msg' => 'only ' . $farm->$available_units . ' available']);
        //         Session(['alert' => 'danger']);
        //         return redirect('farms');
        //     }
        // } else {
        //     // $cart = new Investment_cart;

        //     // $cart->user_id = $user->id;
        //     // $cart->farm_id = $request->farm_id;
        //     // $cart->amount_paid = $request->amount;
        //     // $cart->units = $request->units;
        //     // $cart->save();

        //     Session(['msg' => 'fund wallet to proceed']);
        //     Session(['alert' => 'danger']);
        //     return redirect(route('fundWallet'));
        // }




        // // return view('')

    }

    public function confirmInvestment(Request $request)
    {
        $data['selected_units'] = $request->units;
        $data['farm'] = \DB::table('farms')
            ->join('categories', "farms.farm_type", "=", "categories.id")
            // ->join('categories', "farms.farm_category","=","categories.id")
            ->select('farms.*', 'categories.*', 'categories.name as farmtype', 'categories.image as typeimage', 'farms.id as farm_id')
            ->where('farms.id', $request->farm_id)
            ->first();
        // $data['farm'] = Farm::where('id', $request->farm_id)->first();
        return view('pages.confirm_investment')->with($data);
    }

    public function getFarmcart()
    {
        // $data['farmcart']=Investment_cart::where('user_id', Auth::user()->id)->get();

        $data['farmcart'] = \DB::table('investment_cart')


            ->join('farms', "farms.id", "=", "investment_cart.farm_id")
            ->join('categories', "farms.farm_type", "=", "categories.id")
            // ->join('categories', "farms.farm_category","=","categories.id")
            ->select('investment_cart.*', 'categories.*', 'farms.*', 'categories.name as farmtype', 'categories.image as typeimage', 'farms.id as farm_id', 'investment_cart.id as cartid')
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('pages.farmcart')->with($data);
    }
    public function removeFromCart($id)
    {
        $getCart = Investment_cart::where('id', $id)->first();
        $getCart->delete();
        return redirect()->back()->with('success', 'Item has been removed from cart');
    }

    public function addLandToCart(Request $request, $id)
    {
        $land = LandForSale::findOrFail($id);
        $findCartItem = LandCart::where(['user_id' => Auth::id(), 'land_id'  => $id])->first();
        if ($findCartItem) {
            $findCartItem->amount += $land->price * $request->acres;
            $findCartItem->acres += $request->acres;
            $findCartItem->save();
            return redirect()->back()->with('success', 'Land has been added to cart');
        } else {
            $newLandCart = new LandCart();
            $newLandCart->user_id = Auth::id();
            $newLandCart->amount = $land->price * $request->acres;
            $newLandCart->land_id = $land->id;
            $newLandCart->acres = $request->acres;
            $newLandCart->save();
            return redirect()->back()->with('success', 'Land has been added to cart');
        }
    }
    public function myLands()
    {
        return view('users.my-lands')->with('lands', MyLand::where('user_id', Auth::id())->paginate(10));
    }
    public function getStates(Request $request){
        $country_id=$request->country_id;
       $states=State::where('country_id', $country_id)->get();

       return json_encode($states);

       // $country_arr=[];

   }

   public function getLgas(Request $request){
        $state_id=$request->state_id;
       $lgas=Lga::where('state_id', $state_id)->get();

       return json_encode($lgas);

       // $country_arr=[];

   }

   public function getTowns(Request $request){
        $lga_id=$request->lga_id;
       $towns=Town::where('lga_id', $lga_id)->get();

       return json_encode($towns);

       // $country_arr=[];

   }
}
