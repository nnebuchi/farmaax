<?php

namespace App\Http\Controllers;

use App\Farm;
use App\Category;
use App\FarmPhotos;
use App\Country;
use App\FarmCostAnalysis;
use App\MyFarmSetup;
use App\State;
use Session;
use App\User;
use App\FarmManager;
use App\LandForSale;
use App\Lga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Milestone;
use App\FarmerCost;

class FarmsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->isAdmin == 1) {
            $data['layout'] = 'admin';
        } else {
            $data['layout'] = 'user';
        }

        $data['farms'] = DB::table('farms')
            ->join('categories', "farms.farm_type", "=", "categories.id")
            // ->join('categories', "farms.farm_category","=","categories.id")
            ->select('farms.*', 'categories.*', 'categories.name as farmtype', 'categories.image as typeimage', 'farms.id as farm_id', 'farms.description as farmdescription')
            ->get();
        // dd( $data['farms']);
        // $data['farms']=Farm::where('approved', 1)->latest()->paginate(9);


        return view('farms.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::where('parent', 0)->get();
        $data['farmtypes']  = DB::select("SELECT * FROM categories WHERE parent>0");
        $data['countries']  = Country::all();
        $data['states']     = State::all();
        $data['lgas']       = lga::all();

        /*if (!Auth::check() {
            redirect('login');
        }*/

        if (Auth::user()->isAdmin == 0) {
            return redirect()->back()->with('error', 'You have no permission to access the page');
        } else {
            return view('farms.create')->with($data);
            $data['layout'] = 'admin';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'coverImage' => 'image|mimes:png,jpg,jpeg|max:4000',
            'farmImages.*' => 'image|mimes:png,jpg,jpeg|min:2|max:4000',
        ]);
        if ($request->hasFile('coverImage')) {
            $coverImage = $request->file('coverImage')->getClientOriginalName();
            $coverImageExt = $request->file('coverImage')->getClientOriginalExtension();
            $coverImageName = pathinfo($coverImage, PATHINFO_FILENAME);
            $coverImgToDb = $coverImageName . '_' . time() . '.' . $coverImageExt;
            $saveCoverImage = $request->file('coverImage')->storeAs('public/farmCoverImages', $coverImgToDb);

            $farm = Farm::create([
                // 'owner_id' => Auth::id(),
                'farm_type' => $request->farm_type,
                'farm_category' => $request->farm_category,
                'turn_over_date' => $request->turn_over_date,
                'hand_over_date' => $request->hand_over_date,
                // 'cover_image' => $coverImgToDb,
                // 'description' => $request->description,
                'total_units' => $request->units,
                'state' => $request->state,
                'lga' => $request->lga,
                'town' => $request->town,
                'country' => $request->country,
                'duration' => $request->duration,
                'profit' => $request->profit,
                'overall_cost' => $request->overall_cost,
                'unit_cost' => $request->unit_cost,
                'approved' => 1
            ]);
        }


        //if the user uploaded extra images for the farm
        if ($request->hasFile('farmImages')) {
            foreach ($request->file('farmImages') as $farmImage) {
                $farmImageName = $farmImage->getClientOriginalName();
                $farmImageExt = $farmImage->getClientOriginalExtension();
                $farmImageName = pathinfo($farmImage, PATHINFO_FILENAME);
                $farmImgToDb = $farmImageName . '_' . time() . '.' . $farmImageExt;
                $savefarmImage = $farmImage->storeAs('public/FarmImages', $farmImgToDb);

                FarmPhotos::create([
                    'farm_id' => $farm->id,
                    'images' => $farmImgToDb
                ]);
            }
        }

        //the user is an admin and he will be redirected back to the farms page
        return redirect(route('farms.index'))->with('success', 'Farm has been uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (Auth::user()->isAdmin == 1) {
            $layout = 'admin';
        } else {
            $layout = 'user';
        }
        $getFarm = Farm::where('farm_type', $id)->firstOrFail();
        return view('farms.show')->with(['farm' => $getFarm, 'mainFarmDetails' => Category::where('id', $id)->firstOrFail(), 'layout' => $layout, 'farmPhotos' => FarmPhotos::where('farm_id', $id)->get(), 'owner' => User::findOrFail($getFarm->owner_id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function addcategory()
    {

        $data['categories'] = Category::where('parent', 0)->get();
        return view('farms.addcategory')->with($data);
    }

    public function editcategory($category_id)
    {

        $data['categories'] = Category::where('parent', 0)->get();
        $data['thiscat'] = Category::where('id', $category_id)->first();

        
        return view('farms.editcategory')->with($data);
    }

    public function storecategory(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'categoryName' => 'required',
            'categoryImage' => 'image|required|mimes:png,jpg,jpeg|min:2|max:40000',

        ]);



        if ($request->hasFile('categoryImage')) {

            $categoryImage = $request->file('categoryImage')->getClientOriginalName();

            $categoryImageExt = $request->file('categoryImage')->getClientOriginalExtension();
            $categoryImageName = pathinfo($categoryImage, PATHINFO_FILENAME);
            $categoryImageToDb = $categoryImageName . '_' . time() . '.' . $categoryImageExt;

            $savecategoryImage = $request->file('categoryImage')->storeAs('public/farmcategoryImages', $categoryImageToDb);

            $category = new Category;

            $category->name = $request->categoryName;
            $category->image = $categoryImageToDb;
            $category->parent = 0;
            $category->created_by = 'admin';

            $category->save();
        }

        return redirect('dashboard/admin/addcategory')->with('message', 'New Category added');
    }

    public function updatecategory(Request $request, $id)
    {
        // dd($request);
        $data = $request->validate([
            'categoryName' => 'required',
            'categoryImage' => 'image|mimes:png,jpg,jpeg|min:2|max:40000',

        ]);

        $category = Category::where('id', $id)->first();
        if ($request->hasFile('categoryImage')) {

            if ($request->categoryImage !== null) {
                $categoryImage = $request->file('categoryImage')->getClientOriginalName();

                $categoryImageExt = $request->file('categoryImage')->getClientOriginalExtension();
                $categoryImageName = pathinfo($categoryImage, PATHINFO_FILENAME);
                $categoryImageToDb = $categoryImageName . '_' . time() . '.' . $categoryImageExt;

                $savecategoryImage = $request->file('categoryImage')->storeAs('public/farmcategoryImages', $categoryImageToDb);
                if (file_exists('.' . Storage::url('app/public/farmcategoryImages/' . $category->image))) {
                    unlink('.' . Storage::url('app/public/farmcategoryImages/' . $category->image));
                }
            }
            $category->image = $categoryImageToDb;
        }

        $category->name = $request->categoryName;



        $category->save();

        return redirect('dashboard/admin/editcategory/' . $id)->with('message', 'Category updated');
    }

    public function addfarmtype()
    {

        $data['categories'] = Category::where('parent', 0)->get();
        $data['farmtypes'] = DB::select("SELECT * FROM categories WHERE parent>0");

        return view('farms.addfarmtype')->with($data);
    }

    public function editfarmtype($category_id)
    {

        $data['categories'] = Category::where('parent', 0)->get();
        $data['farmtypes'] = DB::select("SELECT * FROM categories WHERE parent>0");
        $data['thiscat'] = Category::where('id', $category_id)->first();
        return view('farms.editfarmtype')->with($data);
    }

    public function storefarmtype(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'parent' => 'required',
            'image' => 'image|required|mimes:png,jpg,jpeg|min:2|max:40000',
            'name' => 'required'

        ]);



        if ($request->hasFile('image')) {

            $categoryImage = $request->file('image')->getClientOriginalName();

            $categoryImageExt = $request->file('image')->getClientOriginalExtension();
            $categoryImageName = pathinfo($categoryImage, PATHINFO_FILENAME);
            $categoryImageName = str_replace(' ', '-', $categoryImageName); // Replaces all spaces with hyphens.
            $categoryImageName = preg_replace('/[^A-Za-z0-9\-]/', '', $categoryImageName); // Removes special chars.
            $categoryImageName = preg_replace('/-+/', '-',  $categoryImageName);
            $categoryImageToDb = $categoryImageName . '_' . time() . '.' . $categoryImageExt;

            $savecategoryImage = $request->file('image')->storeAs('public/farmcategoryImages', $categoryImageToDb);

            $category = new Category;

            $category->name = $request->name;
            $category->image = $categoryImageToDb;
            $category->parent = $request->parent;
            $category->description = $request->description;
            $category->created_by = 'admin';

            $category->save();
        }

        return redirect('dashboard/admin/addfarmtype')->with('message', 'New Category added');
    }

    public function updatefarmtype(Request $request, $id)
    {
        // dd($request);
        $data = $request->validate([
            'parent' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg|min:2|max:40000',
            'name' => 'required'

        ]);

        $category = Category::where('id', $id)->first();
        if ($request->hasFile('image')) {

            if ($request->image !== null) {
                $image = $request->file('image')->getClientOriginalName();

                $imageExt = $request->file('image')->getClientOriginalExtension();
                $imageName = pathinfo($image, PATHINFO_FILENAME);
                $imageToDb = $imageName . '_' . time() . '.' . $imageExt;

                $saveimage = $request->file('image')->storeAs('public/farmcategoryImages', $imageToDb);
                if (file_exists('.' . Storage::url('app/public/farmcategoryImages/' . $category->image))) {
                    unlink('.' . Storage::url('app/public/farmcategoryImages/' . $category->image));

                    $category->image = $imageToDb;
                }
            }
        }


        $category->name = $request->name;

        $category->parent = $request->parent;

        $category->description = $request->description;


        $category->save();

        return redirect('dashboard/admin/editfarmtype/' . $id)->with('message', 'Category updated');
    }


    public function fetchFarmType(Request $request, $Category_id)
    {
        $farmtpes = Category::where('parent', $Category_id)->get();

        echo json_encode($farmtpes);
    }
    public function farmSetup()

    {

        $data['states'] = State::all();

        $data['farms'] = DB::select("SELECT * FROM categories WHERE parent > 0");

        if (session('hasLand')) {
           session()->forget('hasLand');
        }

       /* $data['farms'] = DB::table('farms')
            ->join('categories', "farms.farm_type", "=", "categories.id")
            // ->join('categories', "farms.farm_category","=","categories.id")
            ->select('farms.*', 'categories.*', 'categories.name as farmtype', 'categories.image as typeimage', 'farms.id as farm_id', 'farms.description as farmdescription')
            ->paginate(10);*/

        return view('farms.farms-setup')->with($data);
    }
    public function confirmFarmSetup(Request $request)
    {
        $data = $request->all();
        // dd($data);
        Session(['farmDetails' => $data]);
        $manager = FarmManager::where('name', $request->nameOfFarm)->first();
        // dd($manager);
        if ($manager) {
            $user = User::findOrFail($manager->user_id);
        } else {
            $user = User::where('isAdmin', 1)->firstOrFail();
        }
        return view('farms.select-farm-manager')->with(['manager' => $user, 'data' => $data]);
    }
    
    public function showCheckoutFormAfterLandPurchase()
    {
        $data  = Session::get('farmDetails');
        $lastData  = Session::get('lastDetails');
        // dd($lastData);

        return view('farms.finalize-farm-setup')->with(['farm' => Category::where('name', $data['nameOfFarm'])->firstOrFail(), 'data' => $lastData, 'farmDetails' => $data]);
        // return view('farms.finalize-farm-setup');
    }

   

    public function showFarmCost(Request $request)
    {
        // dd($request);
        
        if ($request->state_id) {
            if ($request->haveAFarm) {

                if ($request->haveAFarm=='yes') {
                    if (empty($request->address)) {
                        return redirect('start-farm')->with('error', 'You did not enter your farm address');
                    }
                }

                if ($request->haveAFarm=='no') {
                    if (empty($request->lga)) {
                        return redirect('start-farm')->with('error', 'You did select any LGA');
                    }
                }
                
                $user_id = Auth::user()->id;

                $managers = Category::where('id', $request->idOfFarm)->first();

                $exploded = explode(',', $managers->managers);

                $farmerData = 0;

                foreach ($exploded as $manager_id) {

                    if ($request->lga) {
                        $farmerData = DB::select("SELECT * FROM users WHERE id = '$manager_id' AND lga = '$request->lga' AND managesFarm =0 AND id!='$user_id'");
                        if ($farmerData!=null){

                            break;
                        }
                    }
                    
                }

                if (empty($request->lga)) {
                    Session(['hasLand'=>'yes']);
                    $selectedManager = User::where('isAdmin', 1)->first();
                }

                if (empty($farmerData)) {
                    $selectedManager = User::where('isAdmin', 1)->first();
                }else{
                    $selectedManager = $farmerData[0];
                }

                $data['selectedManager'] = $selectedManager;

                $data['haveAFarm'] = $request->haveAFarm;
                
                $data['costs'] = $cost = FarmCostAnalysis::where('farm_type',   $request->idOfFarm)->get();
                if (!is_null($cost)) {
                    $data['all_cost']= $all_cost =FarmCostAnalysis::where('farm_type',   $request->idOfFarm)->sum('amount');

                    
                    $data['farmer_cost'] = $farmer_cost= FarmerCost::where('farm_type',   $request->idOfFarm)->first();

                    if (!is_null($farmer_cost)) {
                        $data['milestones'] = Milestone::where('farmtype', $request->idOfFarm)->get();

                        $farmData['sum']= $data['all_cost'] + $data['farmer_cost']->amount;

                        // dd($farmData['sum']);
                        $farmData['cost'] =$data['costs'][0];
                        $farmData['manager']=$data['selectedManager'];
                        $farmData['lga'] = $request->lga;
                        $farmData['state'] = $request->state_id;

                        Session(['farmData'=>$farmData]);

                        
                    }

                    
                }

                return view('farms.confirm-cost-analysis')->with($data);
                
            }else{
                return redirect('start-farm')->with('error', 'You did not specify if you have a farm or not');
            }
        }else{
            return redirect('start-farm')->with('error', 'you did not select any state');
        }
        
            
       
        
    }

    public function checkLandAvailability(Request $request){

        // dd(session('hasLand'));
        if (session('hasLand')) {
             $acres = (int)$request->acre;
            $prevSession = session('farmData');

            $prevSession['myRequest']=['size'=>$acres];

            Session(['farmData'=> $prevSession]);

            return redirect('finalize-setup');
        }
        $acres = (int)$request->acre;

        $data['requestedSize'] = $acres;
        $choice_state = (int)session('farmData')['state'];
        $lga = (int)session('farmData')['lga'];
// dd($lga);
        // $land = DB::select("SELECT * FROM land_for_sales  LEFT JOIN lgas ON land_for_sales.lga=lgas.id LEFT JOIN states ON land_for_sales.state=states.id WHERE land_for_sales.lga = $lga AND land_for_sales.acres >= $acres");

        $land = DB::select("SELECT ls.*, lgas.name as lgaName, states.name as stateName, land_for_sale_photos.images as landpic  FROM land_for_sales as ls LEFT JOIN lgas ON ls.lga=lgas.id LEFT JOIN states ON ls.state=states.id LEFT JOIN land_for_sale_photos ON ls.id=land_for_sale_photos.land_for_sale_id WHERE ls.lga = $lga AND (ls.acres - ls.purchased) >= $acres AND ls.status = 'available'");


       
        if (empty($land)) {
            $land = DB::select("SELECT ls.*, lgas.name as lgaName, states.name as stateName, land_for_sale_photos.images as landpic FROM land_for_sales as ls LEFT JOIN lgas ON ls.lga=lgas.id LEFT JOIN states ON ls.state=states.id LEFT JOIN land_for_sale_photos ON ls.id=land_for_sale_photos.land_for_sale_id WHERE ls.state =  $choice_state AND (ls.acres - ls.purchased) >= $acres  AND ls.status = 'available'");
        }

        if (!is_null($land)) {
            // session('farmData')['landInfo'] = $land;
            $prevSession = session('farmData');
            
            $prevSession['landInfo']=$land;

            $prevSession['myRequest']=['size'=>$acres];

            Session(['farmData'=> $prevSession]);
            

            // dd(session('farmData'));

        }

        $data['land']=$land;

        /*dd($land);

        dd(session('farmData'));*/

        if (empty($land)) {
            
            $data['stateData']= State::where('id', $choice_state)->first();
        }

        return view('users.finalize_farm_setup')->with($data);


    }

    public function finalizeFarmSetup(){

        // dd(session('farmData')['sum']);

        $myFarmSetup = new  MyFarmSetup;

        if (is_null(session('hasLand'))) {
            $myFarmSetup->land_id = session('farmData')['landInfo'][0]->id;
            
        }
        $myFarmSetup->size = session('farmData')['myRequest']['size'];

        $myFarmSetup->owner_id = Auth::user()->id;

        

        $myFarmSetup->status = 'Pending';

        $myFarmSetup->farm_type = session('farmData')['cost']->farm_type;
        if (is_null(session('hasLand'))) {
            $myFarmSetup->total_farm_cost = (float)session('farmData')['sum'] * (float)session('farmData')['myRequest']['size'];

             $totalLandCost = ((float)session('farmData')['landInfo'][0]->price/(float)session('farmData')['landInfo'][0]->acres) * (float)session('farmData')['myRequest']['size'];

             $myFarmSetup->total_land_cost= $totalLandCost;

        }else{
            $myFarmSetup->total_farm_cost = (float)session('farmData')['sum'];

        }
        
        
        // dd($totalLandCost);

        // $myFarmSetup->farm_type = 

        $myFarmSetup->save();

        return redirect(route('myfarmcart'))->with('success', 'Farm Setup saved, Proceed to make payment');
    }


    public function myFarmCart(){

        /*$data['myfarmcart'] = MyFarmSetup::where('owner_id', Auth::user()->id)
        ->join('land_for_sales', '')
        ->get();*/


        $data['myfarmcart'] = DB::table('my_farm_setups')
            // ->join("land_for_sales", "my_farm_setups.land_id","=","land_for_sales.id")
            ->join('categories', "my_farm_setups.farm_type","=","categories.id")
            ->select('my_farm_setups.*', 'my_farm_setups.status as my_farm_status', 'my_farm_setups.id as my_farm_id', 'categories.image as farmtypeImage')
            ->where(['my_farm_setups.owner_id'=> Auth::user()->id, 'status'=>'pending'])
            ->get(); 
            
            
            // dd($data['myfarmcart']);

           /* $data['myfarmcart2'] = DB::table('my_farm_setups')
            ->join('categories', "my_farm_setups.farm_type","=","categories.id")
            ->select('my_farm_setups.*',  'my_farm_setups.status as my_farm_status', 'my_farm_setups.id as my_farm_id', 'categories.image as farmtypeImage')
            ->where('my_farm_setups.owner_id', '=', Auth::user()->id)
            ->get(); */

            // dd($data['myfarmcart2']);
            
            return view('farms.myfarmcart')->with($data);
    }


    public function showLgas(Request $request)
    {

        $state_id = $request->state_id;
        $results = [];
        $lgas = Lga::where('state_id', $state_id)->get();
        foreach ($lgas as $lga) {

            $lga_data = [
                'name' => $lga->name,
                'id' => $lga->id
            ];
            array_push($results, $lga_data);
        }
        $results = json_encode($results);

        echo $results;
    }


    public function assignFarmManager()
    {
        $managers = User::where([
            ['lga', '=', 15],
            ['farm_manager', '=', 'yes'],
            ['is_engaged', '=', NULL]
        ])
            ->first(['id']);
        $arr = (array)$managers;
        return $managers;
    }

    public function deleteCartfarm($farm_id){

        $farm = MyFarmSetup::where('id', $farm_id)->first();

        if ($farm->owner_id==Auth::user()->id) {
            $farm->delete();

            return redirect('myfarmcart')->with('success', 'farm removed');

        }else{
             return redirect('myfarmcart')->with('error', 'you are not authorised to delete this item');
        }
    }
}
