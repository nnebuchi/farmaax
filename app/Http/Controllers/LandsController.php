<?php

namespace App\Http\Controllers;

use App\LandForSale;
use App\LandForSalePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('lands.index')->with(['lands' => LandForSale::latest()->paginate(6), 'layout' => $layout]);
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
            $layout = 'admin';
        } else {
            $layout = 'auth';
        }
        return view('lands.create')->with('layout', $layout);
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

        $land = LandForSale::create([
            'seller_id' => Auth::id(),
            'landTitle' => $request->landTitle, 'price' => $request->price, 'acres' => $request->acres, 'state' => $request->state, 'lga' => $request->lga, 'town' => $request->town,  'description' => $request->description,
            'address' => $request->address, 'coverImage' => $coverImgToDb
        ]);
        if ($request->hasFile('landImages')) {
            foreach ($request->file('landImages') as $landImage) {
                $landImageName = $landImage->getClientOriginalName();
                $landImageExt = $landImage->getClientOriginalExtension();
                $landImageName = pathinfo($landImage, PATHINFO_FILENAME);
                $landImgToDb = $landImageName . '_' . time() . '.' . $landImageExt;
                $savelandImage = $landImage->storeAs('public/landForSaleLandImages', $landImgToDb);
                LandForSalePhoto::create([
                    'land_for_sale_id' => $land->id,
                    'images' => $landImgToDb
                ]);
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

        if (Auth::user()->isAdmin === '1') {
            return view('admin.lands.show')->with(['land' => LandForSale::findOrFail($id), 'landPhotos' => LandForSalePhoto::where('land_for_sale_id', $id)->get()]);
        } else {
            return view('lands.show')->with(['land' => LandForSale::findOrFail($id), 'landPhotos' => LandForSalePhoto::where('land_for_sale_id', $id)->get()]);
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
}
