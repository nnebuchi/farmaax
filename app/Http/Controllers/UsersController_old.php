<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpgradeRequest;
use App\User;
use App\Country;
use App\State;
use App\Lga;
use App\Bank;
use App\FarmManager;
use App\Investment;
use App\Investment_cart;
use App\MyFarmInvestment;
use App\Category;
use App\Farm;
use App\FarmSetup;
use App\LandCart;
use App\LandForSale;
use App\MyLand;
use App\Payment;
use App\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function upgrade()
    {
        $data['farmType']=\DB::select("SELECT * FROM categories WHERE parent>0");
        $data['title']='Acount Upgrade';
        Session(['page'=>'upgrade-account']);
        if (Auth::user()->account_name == null || Auth::user()->lga==null) {
             $data['banks'] =  \DB::table('banks')->orderBy('name', 'asc')->get();
             $data['countries']=Country::all();
             $data['states'] = State::all();
             $data['lgas'] = Lga::all();
             $data['error']='Please Add your Location and Account Details to proceed';
            return view('users.updateaccount')->with($data);
        }
       /* if (Auth::user()->lga==null) {
             return view('users.addlocation')->with('error', 'Please Add your State and LGA to Proceed');
        }*/
        return view('users.upgrade-account')->with($data);
    }

    public function accountUpgradeAction(Request $request){

        // dd($request);

        $accountType = $request->name;
        if ($accountType=='consultant') {
            $options = [];
            
            foreach ($request->consultant as $option) {

                $options[$option]=$option;
                //array_push($options, $option);
            }

            Session(['options'=>$options]);

        
            return redirect(url('consultant_reg_fee'));

            
        }

        if ($accountType=='farm_manager') {
            $options = [];
            $data_to_insert =[];
            
            foreach ($request->farm_type as $option=>$value) {
                array_push($data_to_insert, $value);

                $options[$option]=$option; 

                $category = Category::where('id', (int)$value)->first() ;

                // $category_managers = $category->managers;

                if (empty($category->managers)) {
                   
                   $category->managers = Auth::user()->id;

                }else{


                    $exploded = explode(',', $category->managers);
                    // dd($exploded);
                    if (in_array(Auth::user()->id, $exploded)==false) {
                        $category->managers = $category->managers.','.Auth::user()->id;
                    }
                    
                }

                $category->save();




                //array_push($options, $option);
            }
           /* dd(json_encode($data_to_insert))    ;
            dd($options);*/
            $farm_manager = FarmManager::where('user_id', Auth::user()->id)->first();
            if (!is_null($farm_manager)) {

                 $farm_manager->farm_type= json_encode($data_to_insert);
            }else{
                $farm_manager = new FarmManager;

                $farm_manager->user_id = Auth::user()->id;
                $farm_manager->farm_type = json_encode($data_to_insert);
            }

            
            $farm_manager->save();

            $user = User::where('id', Auth::user()->id)->first();
            // $user->farm_manager = 'farm_manager';




            // dd($farm_manager);

            // Session(['farmtype'=>$options]);

        // dd(session('options'));
            return redirect(url('dashboard'))->with('success', 'Account upgrade successful');

            
        }

    }


    public function enterFarManagementProfile(){

        return view('users.enter_farm_management_profile');
    }
    public function storeBankAccountDetails(Request $request)
    {
        $data =  $request->validate([

            'account_name' => 'required|string',
            'account_number' => 'required',
            'bank_name' => 'required|string',
            'state'     => 'required|integer',
            'country'   =>  'required|integer',
            'lga'       =>  'required|integer',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->account_name = $data['account_name'];
        $user->account_number = $data['account_number'];
        $user->bank_name = $data['bank_name'];
        $user->country = $data['country'];
        $user->state = $data['state'];
        $user->lga = $data['lga'];
        $user->save();
        if (session('previous_page')) {
             return redirect(session('previous_page'))->with('success', 'Account information updated, you can fund wallet now');
        }
        return redirect()->intended('/dashboard')->with('success', 'Account information successfully updated');
    }
    public function showFundingWalletView()
    {
        
        if (Auth::user()->account_name == null) {
            Session(['previous_page'=>url('fund-wallet')]);
            $data['countries'] = Country::all();
            $data['banks'] = Bank::all();
            $data['error']='Please update your account to enable you fund wallet';

            return view('users.updateaccount')->with($data);
        }
        return view('users.fund-wallet');
    }
    public function showMyLandsForSale()
    {
        return view('lands.mylands-for-sale')->with('lands', LandForSale::where('seller_id', Auth::id())->paginate(10));
    }
    public function farmsInvestedIn()
    
    {   
        $user = User::where('id', Auth::user()->id)->first();

        $data['farms'] = \DB::table('my_farm_investments')
        ->join('farms', "farms.id", "=", "my_farm_investments.farm_id")
        ->join('categories', "farms.farm_type","=","categories.id")
        ->join('states', "farms.state","=","states.id")
        ->join('lgas', "farms.lga","=","lgas.id")
        ->join('towns', "farms.town","=","towns.id")
        ->select('farms.*', 'my_farm_investments.*', 'categories.*', 'states.*','towns.*','farms.farm_type as farmtype','farms.farm_category as farmcategory', 'states.name as statename',  'towns.name as townname', 'lgas.name as lganame', 'my_farm_investments.created_at as creationDate', 'categories.name as farm_type')
        ->where(['my_farm_investments.user_id' => $user->id])
        ->get();


        // dd( $data['farms']);

        return view('farms.farmsInvestedIn')->with($data);
    }


    public function confirmInvestment(Request $request)
    {   
        Session(['previous_page'=>url('farmcart')]);
        $data['selected_units'] = $request->units;
        $data['farm'] = \DB::table('farms')
            ->join('categories', "farms.farm_type", "=", "categories.id")
            
            ->select('farms.*', 'categories.*', 'categories.name as farmtype', 'categories.image as typeimage', 'farms.id as farm_id')
            ->where(['farms.id'=>$request->farm_id])
            ->first();
        // $data['farm'] = Farm::where('id', $request->farm_id)->first();

            // dd($data['farm'] );
        return view('pages.confirm_investment')->with($data);
    }

    public function getFarmcart()
    {
        if (session('previous_page')){
            session()->forget('previous_page');
        }
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
        $data['lands'] = \DB::table('my_lands')
        ->join('states', "my_lands.state", "=", "states.id")
        ->join('lgas', 'my_lands.lga', '=', 'lgas.id')

        ->select('my_lands.*', 'states.*', 'lgas.*', 'lgas.name as lgaName', 'states.name as stateName', 'my_lands.id as land_id', 'states.id as stateId', 'lgas.id as lgaId', 'my_lands.created_at as purchaseDate')
        ->where('my_lands.user_id', Auth::id())
        ->paginate(10);

        // dd($data['lands']);
        return view('users.my-lands')->with($data);
    }
    public function getStates(Request $request)
    {
        $country_id = $request->country_id;
        $states = State::where('country_id', $country_id)->get();

        return json_encode($states);

        // $country_arr=[];

    }

    public function getLgas(Request $request)
    {
        $state_id = $request->state_id;
        $lgas = Lga::where('state_id', $state_id)->get();

        return json_encode($lgas);

        // $country_arr=[];

    }

    public function getTowns(Request $request)
    {
        $lga_id = $request->lga_id;
        $towns = Town::where('lga_id', $lga_id)->get();

        return json_encode($towns);

        // $country_arr=[];

    }


    public function myTransactions(){
        $data['transactions'] = payment::where('user_id', Auth::user()->id)->get();

        return view('users.transactions')->with($data);        
        
    }

    public function myLandDetail($id){

        $data['lands']= MyLand::where(['user_id'=>Auth::id(), 'id'=>$id])->first();
        return view('users.myland_detail')->with($data);
    }


    public function myFarmSetups(){
        // $data['myfarms'] = FarmSetup::where('owner_id', Auth::user()->id)
        $data['myfarms'] = \DB::table('my_farm_setups')
        ->join('categories', 'my_farm_setups.farm_type', '=', 'categories.id')
        ->select('my_farm_setups.*', 'categories.*')
        ->where(['my_farm_setups.owner_id'=>Auth::user()->id, 'my_farm_setups.status'=>'paid'])
        ->paginate(10);
        // dd($data['myfarms'][0]);
        $farmArr=[];

        foreach ($data['myfarms'] as $farmdata) {
            // dd($farmdata);
           
        
            // dd($farmArr[0]);
            if ((int)$farmdata->land_id>0) {

                $land_id = (int)$farmdata->land_id;
                
                $landDetail = \DB::table('land_for_sales')
                ->join('states', "land_for_sales.state", "=", "states.id")
                ->join('lgas', 'land_for_sales.lga', '=', 'lgas.id')
                ->select('land_for_sales.*', 'states.*', 'lgas.*', 'lgas.name as lgaName', 'states.name as stateName')
                ->where('land_for_sales.id', $land_id)->first();

                $farmdata->landDetail=$landDetail;
                // dd($farmdata);
                 // array_push($farmdata, $land_id);

            // dd($landDetail);
            }

            array_push($farmArr, $farmdata);

        }
        /*$data['myfarms'] = \DB::table('my_farm_setups')
        ->join('land_for_sales', 'land_for_sales.id', '=', 'my_farm_setups.land_id')
        ->join('states', "land_for_sales.state", "=", "states.id")
        ->join('lgas', 'land_for_sales.lga', '=', 'lgas.id')

        ->select('my_farm_setups.*', 'land_for_sales.*', 'states.*', 'lgas.*', 'lgas.name as lgaName', 'states.name as stateName', 'my_farm_setups.id as land_id', 'states.id as stateId', 'lgas.id as lgaId', 'my_farm_setups.created_at as purchaseDate')
        ->where('my_farm_setups.owner_id', Auth::id())
        ->paginate(10);*/
         // dd($farmArr);
         $data['farmArr'] = $farmArr;
        return view('users.myfarm_setups')->with($data);

        
    }

    public function myDownlines(){

        $data['downlines'] = User::where('parent', Auth::user()->id)->get();

        
        return view('users.downlines')->with($data);
    }

    public function myEarnings(){
        $data['earnings'] = Earning::where('user_id', Auth::user()->id)->get();

        
        return view('users.earnings')->with($data);
    }

    
}
