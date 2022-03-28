<?php

namespace App\Http\Controllers;

use App\LandForSale;
use App\LandForSalePhoto;
use App\LandCart;
use App\Lga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LandsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::user()->isAdmin == 1) {
            $layout = 'admin';
        } else {
            $layout = 'app';
        }
        $data['lands'] = LandForSale::latest()->paginate(6);
        $data['layout'] = $layout;
        return view('lands.index')->with($data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->isAdmin == 1) {
            $data['layout'] = 'admin';
        } else {
            $data['layout'] = 'auth';
        }
        $data['myStateLga'] = Lga::where('state_id', Auth::user()->state)->get();
        return view('lands.create')->with($data);
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
        $request->validate([
            'landTitle' => 'required|string',
            'price' => 'required',
            'acres' => 'required',
            'state' => 'required|string',
            'lga' => 'required|string',
            'town' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'coverImage' => 'image|required|mimes:png,jpg,jpeg|max:6000',
            'landImages.*' => 'image|required|mimes:png,jpg,jpeg|min:2|max:6000',
            'termsAndConditions' => 'required|accepted'
        ]);
        if ($request->hasFile('coverImage')) {
            $coverImage = $request->file('coverImage')->getClientOriginalName();
            $coverImageExt = $request->file('coverImage')->getClientOriginalExtension();
            $coverImageName = pathinfo($coverImage, PATHINFO_FILENAME);
            $coverImgToDb = $coverImageName . '_' . time() . '.' . $coverImageExt;
            $saveCoverImage = $request->file('coverImage')->storeAs('public/landForSaleCoverImages', $coverImgToDb);
        }

        /*$land = LandForSale::create([
            'seller_id' => Auth::id(),
            'landTitle' => $request->landTitle, 'price' => $request->price, 'acres' => $request->acres, 'state' => $request->state, 'lga' => $request->lga, 'town' => $request->town,  'description' => $request->description,
            'address' => $request->address, 'coverImage' => $coverImgToDb
        ]);*/


        $land = new LandForSale;

        $land->seller_id= Auth::id();
        $land->landTitle = $request->landTitle;
        $land->price = $request->price;
        $land->acres = $request->acres;
        $land->state = $request->state;
        $land->lga = $request->lga;
        $land->town = $request->town;
        $land->description = $request->description;
        $land->address = $request->address;
        $land->coverImage = $coverImgToDb;

        $land->save();

        if ($request->hasFile('landImages')) {

            foreach ($request->file('landImages') as $landImage) {
                $landImageName = $landImage->getClientOriginalName();
                $landImageExt = $landImage->getClientOriginalExtension();
                $landImageName = pathinfo($landImage, PATHINFO_FILENAME);
                $landImgToDb = $landImageName . '_' . time() . '.' . $landImageExt;
                $savelandImage = $landImage->storeAs('public/landForSaleLandImages', $landImgToDb);

                $landPhoto = new LandForSalePhoto;

                $landPhoto->land_for_sale_id = $land->id;
                $landPhoto->images = $landImgToDb;

                $landPhoto->save();

               /* LandForSalePhoto::create([
                    'land_for_sale_id' => $land->id,
                    'images' => $landImgToDb
                ]);*/
            }
        }
        return redirect(route('lands.show', $land->id))->with('success', 'Your land has been uploaded for sale on Farmaax.');
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

        

            $data['land'] = DB::table('land_for_sales')
                ->join('states', "states.id", "=", "land_for_sales.state")
                ->join('lgas', "lgas.id", "=", "land_for_sales.lga")
                ->select('land_for_sales.*', 'lgas.name as lgaName', 'states.name as stateName')
                ->where(['land_for_sales.id'=>$id])
                ->first();

                $data['landPhotos']= LandForSalePhoto::where('land_for_sale_id', $id)->get();

                if (Auth::user()->isAdmin === '1') {
                    return view('admin.lands.show')->with($data);
                } else {

                // dd($data['land']);
                return view('lands.show')->with($data);

            /*$data['farm'] = DB::table('categories')
            ->join('farm_cost_analyses', "categories.id", "=", "farm_cost_analyses.farm_type")
            ->select('categories.*', 'farm_cost_analyses.*', 'farm_cost_analyses.id as anal_id')
            ->where(['categories.id'=>$id])
            ->get();*/
            // return view('lands.show')->with(['land' => LandForSale::findOrFail($id), 'landPhotos' => LandForSalePhoto::where('land_for_sale_id', $id)->get()]);
        }
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

    public function landCart(){

        $data['landcart'] = \DB::table('land_carts')
        ->join('land_for_sales', "land_for_sales.id", "=", "land_carts.land_id")
        ->select('land_carts.*', 'land_for_sales.*', 'land_for_sales.acres as grossLandSize', 'land_carts.acres as selectedSize', 'land_carts.id as cartid')
        ->where('land_carts.user_id', Auth::user()->id)
        ->get();
// dd( count($data['landcart']));
        return view('lands.landcart')->with($data);

    }


    public function deleteCartLand($cart_id){

        $cart =LandCart::where('id', $cart_id)->first();

        // dd($cart);

        if ($cart->user_id==Auth::user()->id) {
            $cart->delete();

            return redirect(url('landcart'))->with('success', 'land removed');

        }else{
             return redirect('landcart')->with('error', 'you are not authorised to delete this item');
        }
    }

    public function editLandForSale($landId){
        
        $data['land'] = $land = LandForSale::where('id', $landId)->first();

        $data['landPhotos']= LandForSalePhoto::where('land_for_sale_id', $land->id)->get();

        $data['myStateLga'] = Lga::where('state_id', $land->state)->get();
         if($land->seller_id == Auth::user()->id || (int)Auth::user()->isAdmin==1){
            return view('lands.edit')->with($data);
         }else{
           return redirect()->back()->with('error', 'you are not allowed to edit this');
         }

    }



    public function updateLandForSale(Request $request, $landId){

        // dd($request->landImages);

        // dd($request->file('productImages'));


        $land = LandForSale::where('id', $landId)->first();
         // dd($land->coverImage);
        // dd($land->coverImage);

        if($land->seller_id == Auth::user()->id || (int)Auth::user()->isAdmin==1){

            $land->landTitle            = $request->landTitle;
            $land->address              = $request->address;
            // $land->coverImage           = $request->coverImage;
            $land->price                = $request->price;
            $land->state                = $request->state;
            $land->description          = $request->description;
            $land->lga                  = $request->lga;
            $land->town                 = $request->town;
            $land->acres                = $request->acres;

            // dd($land);

            

            if ($request->hasFile('photo'))
            {
               

                if (file_exists('.' . Storage::url('app/public/landForSaleCoverImages/' . $land->coverImage))) {

                    // dd($land->coverImage);

                        unlink('.' . Storage::url('app/public/landForSaleCoverImages/' . $land->coverImage));
                }


                $landPhoto         = $request->photo;

                $landPhotoName = $landPhoto->getClientOriginalName();
                $landPhotoExt = $landPhoto->getClientOriginalExtension();
                $landPhotoName = pathinfo($landPhoto, PATHINFO_FILENAME);
                $landImgToDb = $landPhotoName . '_' . time() . '.' . $landPhotoExt;
                $savelandPhoto = $landPhoto->storeAs('public/landForSaleCoverImages', $landImgToDb);
                $land->coverImage         = $landImgToDb;

            }else{
                
                $land->coverImage = $request->current_photo;
            }
            

            $land->save();


            // process other land image
            if ($request->hasFile('landImages')) {
                $exArr = [];
                foreach ($request->file('landImages') as $key=>$value) {
                    array_push($exArr, $key);

                    if (in_array($key, $exArr)) {

                        $land_photo = LandForSalePhoto::where('id', $key)->first();
                    
                        if (file_exists('.' . Storage::url('app/public/landForSaleLandImages/'.$land_photo->images))) {
                            unlink('.' . Storage::url('app/public/landForSaleLandImages/'.$land_photo->images));
                        }

                        $landImage = $request->landImages[$key];
                        
                        $landImageName = $landImage->getClientOriginalName();
                        $landImageExt = $landImage->getClientOriginalExtension();
                        $landImageName = pathinfo($landImage, PATHINFO_FILENAME);
                        $landImgToDb = $landImageName . '_' . time() . '.' . $landImageExt;
                        $savelandImage = $landImage->storeAs('public/landForSaleLandImages', $landImgToDb);
                        $land_photo->images = $landImgToDb;

                        $land_photo->save();
                    }else{
                         $land_photo = LandForSalePhoto::where('id', $key)->first();

                            $land_photo->images = $request->current_image[$key];

                            $land_photo->save();
                    }

                    
                    
                }

                /*foreach ($request->current_image as $key => $value) {
                    if (!in_array($key, $exArr)) {

                         $land_photo = LandForSalePhoto::where('id', $key)->first();

                       $land_photo->images = $request->current_image[$key];

                        $land_photo->save();
                    }
                }*/

            }else{
                // dd($request->current_image);
                // dd('here');
               foreach ($request->current_image as $key => $value) {

                        $land_photo = LandForSalePhoto::where('id', $key)->first();

                       $land_photo->images = $request->current_image[$key];

                        $land_photo->save();
                    
                }
            }

            return redirect(route('edit-land', $landId))->with('success', 'land updated');
        }else{
             return redirect()->back()->with('error', 'you are not allowed to edit this');
        }
    }


    public function deleteLandForSale($id){

        $land = LandForSale::where('id', $id)->first();

        // dd($land);

        if (file_exists('.' . Storage::url('app/public/landForSaleCoverImages/' . $land->coverImage))) {

            unlink('.' . Storage::url('app/public/landForSaleCoverImages/' . $land->coverImage));
        }

        $photos = LandForSalePhoto::where('land_for_sale_id', $land->id)->get();
        foreach ($photos as $photo) {
            if (file_exists('.' . Storage::url('app/public/landForSaleLandImages/' . $photo->images))) {

                unlink('.' . Storage::url('app/public/landForSaleLandImages/' . $photo->images));
            }

            $photo->delete();
        }

        $land->delete();
        
        return redirect()->back()->with('success', 'land removed');

    }
}
