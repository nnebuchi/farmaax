<?php

namespace App\Http\Controllers;

use App\FarmCostAnalysis;
use App\Farm;
use App\Category;
use App\ProductCategory;
use App\ProductPhoto;
use App\Product;
use App\FarmPhotos;
use App\LandForSale;
use App\Lga;
use App\State;
use App\SiteSetting;
use App\Mail\YourFarmHasBeenApproved;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Milestone;
use App\FarmerCost;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    public function lawyers()
    {
        return view('admin.users.lawyers')->with(['users' => User::where('lawyer', 'yes')->get(), 'name' => 'Lawyers']);
    }
    public function realtors()
    {
        return view('admin.users.realtors')->with(['users' => User::where('realtor', 'yes')->get(), 'name' => 'Realtors']);
    }
    public function marketers()
    {
        return view('admin.users.marketers')->with(['users' => User::where('marketer', 'yes')->get(), 'name' => 'Marketers']);
    }
    public function farmManagers()
    {
        return view('admin.users.farm-managers')->with(['users' => User::where('farm_manager', 'yes')->get(), 'name' => 'Farm Managers']);
    }
    public function assignFarm($id)
    {
        return view('admin.farms.assign-farm')->with(['farms' => Farm::where('manager_id', null)->get(), 'id' => $id]);
    }
    public function showCostAnalysisForm($id)
    {

            $data['farm'] = DB::table('categories')
            ->join('farm_cost_analyses', "categories.id", "=", "farm_cost_analyses.farm_type")
            ->select('categories.*', 'farm_cost_analyses.*', 'farm_cost_analyses.id as anal_id')
            ->where(['categories.id'=>$id])
            ->get();
            
            $data['id']=$id;
        $data['farmtype']=Category::findOrFail($id);
        $data['farmer_cost']=FarmerCost::where('farm_type', $id)->first();

        return view('admin.cost-analysis')->with($data);

    }
    public function storeCostAnalysis(Request $request, $farmId)
    {

        $farmer_cost = new FarmerCost;
        $farmer_cost->farm_type = $farmId;
        $farmer_cost->amount = $request->farmer_cost;
        $farmer_cost->save();

        $count=0;
        foreach ($request->parameters as $parameter) {

            // array_push($analysis, $parameter);
            $costAnalysis = new FarmCostAnalysis;
            $costAnalysis->farm_type = $farmId;
            $costAnalysis->parameter = $parameter;
            $costAnalysis->amount =$request->amount[$count];
            $costAnalysis->save();

            $count++;
        }
        return redirect()->back()->with("success", 'Farm Cost Analysis has been added successfully');
    }

    public function updateCostAnalysis(Request $request, $farmId){

        // dd($request);

        $farmer_cost = FarmerCost::where('farm_type', $farmId)->first();
        if (is_null($farmer_cost)) {
            $farmer_cost = new FarmerCost;
            $farmer_cost->farm_type = $farmId;
        }        
        $farmer_cost->amount = $request->farmer_cost;
        // number_format($request->farmer_cost, 2, '.', '');
        $farmer_cost->save();
        
        foreach ($request->parameters as $key => $parameter) {
            $costAnalysis = FarmCostAnalysis::where('id', $key)->first();
            $costAnalysis->parameter = $parameter;
            $costAnalysis->save();
        }


        foreach ($request->amounts as $key => $amount) {
            $costAnalysis = FarmCostAnalysis::where('id', $key)->first();
            $costAnalysis->amount = $amount;
            $costAnalysis->save();
        }

        if ($request->new_params) {
            $count=0;
            foreach ($request->new_params as $parameter) {

                // array_push($analysis, $parameter);
                $costAnalysis = new FarmCostAnalysis;
                $costAnalysis->farm_type = $farmId;
                $costAnalysis->parameter = $parameter;
                $costAnalysis->amount =$request->new_amounts[$count];
                $costAnalysis->save();

                $count++;
            }  
        }
        
        return redirect()->back()->with("success", 'Farm Cost Analysis has been updated successfully');
    }


    public function showFarmManaged($id)
    {
        $farm  =  Farm::where('manager_id', $id)->first();
        $user = User::findOrFail($id);
        $manager = $user->firstName . ' ' . $user->lastName;
        return view('admin.farms.showFarmManagedByUser')->with(['farm' => $farm, 'manager' => $manager, 'farmPhotos' => FarmPhotos::where('farm_id', $farm->id)->get()]);
    }
    public function makeUserAFarmManager($user, $farm)
    {
        $getUser = User::findOrFail($user);
        $getUser->managesFarm = 1;
        $getUser->save();
        $getFarm  = Farm::findOrFail($farm);
        $getFarm->manager_id =  $getUser->id;
        $getFarm->save();
        return redirect(route('farmManagers'))->with('success', 'You have Successfully assigned a farm to a Farm Manager');
    }
    public function farms()
    {
        return view('admin.farms.index')->with('farms', Farm::latest()->paginate(6));
    }
    public function lands()
    {
        return view('admin.lands.index')->with('lands', LandForSale::latest()->paginate(6));
    }
    public function sellLands()
    {
        $data['layout'] = 'admin';
         $data['myStateLga'] = Lga::where('state_id', Auth::user()->state)->get();
        return view('lands.create')->with($data);
    }

    public function soldLands()
    {
        return view('admin.lands.sold-lands')->with('lands', LandForSale::where('status', 'sold')->OrderBy('created_at', 'DESC')->get());
    }
    public function availableLands()
    {
        return view('admin.lands.available-lands')->with('lands', LandForSale::where('status', 'available')->OrderBy('created_at', 'DESC')->get());
    }
    public function users()
    {
        return view('admin.users.index')->with('users', User::latest()->get());
    }
    public function findUser($user)
    {

        $findUser = User::findOrFail($user);
        return view('admin.users.show')->with('user', $findUser);
    }
    public function farmsAwaitingApproval()
    {

        $farm = Farm::where('approved', 0)->latest()->paginate(9);
        return view('admin.farms.awaiting-approval')->with('farms', $farm);
    }
    public function showFarmsAwaitingApproval($id)
    {

        $farm = Farm::where(['id' => $id, 'approved' => 0])->firstOrFail();
        $farmPhotos = FarmPhotos::where('farm_id', $farm->id)->get();
        return view('admin.farms.awaiting-approval-show')->with(['farm' => $farm, 'farmPhotos' => $farmPhotos]);
    }

    public function approveFarmsAwaitingApproval($id)
    {

        $farm = Farm::findOrFail($id);
        $farm->approved = 1;
        $farm->save();
        $user = User::findOrFail($farm->owner_id);
        Mail::to($user->email)->send(new YourFarmHasBeenApproved($user, $farm));
        return redirect(route('farms.index'))->with('success', 'You have approved a land');
    }


    public function addProduct(){

        $data['product_categories'] = ProductCategory::all();
        return view('admin.store.addproduct')->with($data);
    }

    public function storeProduct(Request $request){

        // dd($request->file('photo'));

        $product = new Product;

        $product->title         = $request->title;
        $product->quantity      = $request->quantity;
        $product->price         = $request->price;
        $product->category      = $request->category;
        $product->weight        = $request->weight;
        $product->description   = $request->description;
        $product->slug          = $request->title.'-'.microtime();

        // process cover image
        $productPhoto         = $request->photo;

        $productPhotoName = $productPhoto->getClientOriginalName();
        $productPhotoExt = $productPhoto->getClientOriginalExtension();
        $productPhotoName = pathinfo($productPhoto, PATHINFO_FILENAME);
        $productImgToDb = $productPhotoName . '_' . time() . '.' . $productPhotoExt;
        $saveproductPhoto = $productPhoto->storeAs('public/storeProductCoverPhotos', $productImgToDb);

        $product->photo = $productImgToDb;

        $product->save();


        // process other product image
        if ($request->hasFile('productImages')) {
            foreach ($request->file('productImages') as $productImage) {
                $productImageName = $productImage->getClientOriginalName();
                $productImageExt = $productImage->getClientOriginalExtension();
                $productImageName = pathinfo($productImage, PATHINFO_FILENAME);
                $productImgToDb = $productImageName . '_' . time() . '.' . $productImageExt;
                $saveproductImage = $productImage->storeAs('public/storeProductImages', $productImgToDb);

                $product_photo = new ProductPhoto;
                $product_photo->product_id = $product->id;
                $product_photo->product_image = $productImgToDb;

                $product_photo->save();
                /*productForSalePhoto::create([
                    'land_for_sale_id' => $land->id,
                    'images' => $landImgToDb
                ]);*/
            }
        }

        return redirect(route('edit-product', $product->id))->with('success', 'product uploaded');
    }

     public function editProduct($productId){
        
        $data['product'] = Product::where('id', $productId)->first();
        if (is_null($data['product'])) {
            die('invalid request');
        }
        $data['product_categories'] = ProductCategory::all();
        $data['product_photos'] = ProductPhoto::where('product_id', $productId)->get();

        return view('admin.store.editproduct')->with($data);
    }



     public function updateProduct(Request $request, $productId){

        // dd($request->file('productImages'));


        $product = Product::where('id', $productId)->first();

        $product->title         = $request->title;
        $product->quantity      = $request->quantity;
        $product->price         = $request->price;
        $product->category      = $request->category;
        $product->weight        = $request->weight;
        $product->description   = $request->description;

        // process cover image

        if ($request->hasFile('photo'))
        {
            // dd($request->file());
            // Storage::disk('public')->delete('storeProductCoverPhotos/'.$product->photo);

            if (file_exists('.' . Storage::url('app/public/storeProductCoverPhotos/' . $product->photo))) {
                    unlink('.' . Storage::url('app/public/storeProductCoverPhotos/'.$product->photo));
                }


            $productPhoto         = $request->photo;

            $productPhotoName = $productPhoto->getClientOriginalName();
            $productPhotoExt = $productPhoto->getClientOriginalExtension();
            $productPhotoName = pathinfo($productPhoto, PATHINFO_FILENAME);
            $productImgToDb = $productPhotoName . '_' . time() . '.' . $productPhotoExt;
            $saveproductPhoto = $productPhoto->storeAs('public/storeProductCoverPhotos', $productImgToDb);
            $product->photo         = $productImgToDb;

        }else{
            $product->photo = $request->current_photo;
        }
        

        $product->save();


        // process other product image
        if ($request->hasFile('productImages')) {
            $exArr = [];
            // dd($request->current_image[1]);
            foreach ($request->file('productImages') as $key=>$value) {
                array_push($exArr, $key);

                $product_photo = ProductPhoto::where('id', $key)->first();

                // dd($product_photo->);
                // dd($product_photo);
                // Storage::disk('public')->delete('storeProductImages/'.$product_photo->product_image);

                
                if (file_exists('.' . Storage::url('app/public/storeProductImages/' . $product_photo->product_image))) {
                    unlink('.' . Storage::url('app/public/storeProductImages/' . $product_photo->product_image));
                }

                $productImage = $request->productImages[$key];
                // dd($productImage);
                $productImageName = $productImage->getClientOriginalName();
                $productImageExt = $productImage->getClientOriginalExtension();
                $productImageName = pathinfo($productImage, PATHINFO_FILENAME);
                $productImgToDb = $productImageName . '_' . time() . '.' . $productImageExt;
                $saveproductImage = $productImage->storeAs('public/storeProductImages', $productImgToDb);
                $product_photo->product_image = $productImgToDb;

                $product_photo->save();
                /*productForSalePhoto::create([
                    'land_for_sale_id' => $land->id,
                    'images' => $landImgToDb
                ]);*/
            }

            foreach ($request->current_image as $key => $value) {
                if (!in_array($key, $exArr)) {

                     $product_photo = ProductPhoto::where('id', $key)->first();

                   $product_photo->product_image = $request->current_image[$key];

                    $product_photo->save();
                }
            }

        }else{
           foreach ($request->current_image as $key => $value) {

                    $product_photo = ProductPhoto::where('id', $key)->first();

                   $product_photo->product_image = $request->current_image[$key];

                    $product_photo->save();
                
            }
        }

        return redirect(route('edit-product', $productId))->with('success', 'product updated');
    }

    public function settings(){

        $data['settings'] = SiteSetting::first();
        return view('admin/settings')->with($data);
    }

    public function updateSettings(Request $request){

        // dd($request->request);
        
        $settings = SiteSetting::first();

        $settings->consultant_signup_fee = $request->consultant_signup_fee;
        $settings->consultant_referral_bonus = $request->consultant_referral_bonus;
        $settings->paystack_key = $request->paystack_key;

        $settings->save();

        return redirect('dashboard/admin/settings')->with('success', 'settings updated');
    }

    public function addMilestone($farmId){
        $data['farm'] = $farmtype = Category::where('id', $farmId)->first();
        $data['milestones'] = Milestone::where('farmtype', $farmtype->id)->get();
        return view('farms.addmilestone')->with($data);
    }

    public function storeMilestone(Request $request, $farmId){

        foreach ($request->milestones as $milestone) {
            $stone = new Milestone;
            $stone->farmtype = $farmId;
            $stone->title = $milestone;

            $stone->save();
        }

        return redirect(route('add-milestone', $farmId))->with('success', 'milestones added');
    }

    public function editMilestone($id){
        
        $data['milestone'] = Milestone::where('id', $id)->first();
        return view('farms.editmilestone')->with($data);
    }

    public function updateMilestone(Request $request, $id){
        
        $stone = Milestone::where('id', $id)->first();
        $stone->title = $request->milestone;
        $stone->save();
        return redirect(route('edit-milestone', $id))->with('success', 'milestones updated');
   
    }

    public function deleteMilestone($id){
        Milestone::where('id', $id)->delete();

        return redirect()->back()->with('success', 'milestone removed');
    }
}   
