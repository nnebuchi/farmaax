<?php

namespace App\Http\Controllers;

use App\Farm;
use App\Category;
use App\FarmPhotos;
use App\Country;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            ->select('farms.*', 'categories.*', 'categories.name as farmtype', 'categories.image as typeimage', 'farms.id as farm_id')
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
        $data['farmtypes'] = DB::select("SELECT * FROM categories WHERE parent>0");
        $data['countries'] = Country::all();
        $data['states'] = State::all();
        
        /*if (!Auth::check() {
            redirect('login');
        }*/

        if (Auth::user()->isAdmin == 1) {
            $data['layout'] = 'admin';
        } else {
            $data['layout'] = 'user';
        }
        return view('farms.create')->with($data);
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

            if (Auth::user()->isAdmin == 0) {
                //if the user is not an admin, his farm will need to approved by the admin
                $farm =  Farm::create([
                    'owner_id' => Auth::id(),
                    'farm_type' => $request->farm_type,
                    'farm_category' => $request->farm_category,
                    'turn_over_date' => $request->turn_over_date,
                    'hand_over_date' => $request->hand_over_date,
                    'cover_image' => $coverImgToDb,
                    'description' => $request->description,
                    'total_units' => $request->units,
                    'state' => $request->state,
                    'lga' => $request->lga,
                    'town' => $request->town,
                    'country' => $request->country,
                    'duration' => $request->duration,
                    'profit' => $request->profit,
                    'overall_cost' => $request->overall_cost,
                    'unit_cost' => $request->unit_cost,
                    'approved' => 0
                ]);
            } // if the user is the admin, his farm will be approved automatically
            else {
                $farm = Farm::create([
                    'owner_id' => Auth::id(),
                    'farm_type' => $request->farm_type,
                    'farm_category' => $request->farm_category,
                    'turn_over_date' => $request->turn_over_date,
                    'hand_over_date' => $request->hand_over_date,
                    'description' => $request->description,
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
        } else {
            if (Auth::user()->isAdmin == 0) {
                //if the user is not an admin, his farm will need to approved by the admin
                $farm =  Farm::create([
                    'owner_id' => Auth::id(),
                    'farm_type' => $request->farm_type,
                    'farm_category' => $request->farm_category,
                    'turn_over_date' => $request->turn_over_date,
                    'hand_over_date' => $request->hand_over_date,
                    // 'cover_image' => $coverImgToDb,
                    'description' => $request->description,
                    'total_units' => $request->units,
                    'state' => $request->state,
                    'lga' => $request->lga,
                    'town' => $request->town,
                    'country' => $request->country,
                    'duration' => $request->duration,
                    'profit' => $request->profit,
                    'overall_cost' => $request->overall_cost,
                    'unit_cost' => $request->unit_cost,
                    'approved' => 0
                ]);
            } // if the user is the admin, his farm will be approved automatically
            else {
                $farm = Farm::create([
                    'owner_id' => Auth::id(),
                    'farm_type' => $request->farm_type,
                    'farm_category' => $request->farm_category,
                    'turn_over_date' => $request->turn_over_date,
                    'hand_over_date' => $request->hand_over_date,
                    // 'cover_image' => $coverImgToDb,
                    'description' => $request->description,
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
        if (Auth::user()->isAdmin == 0) {
            //if the user is not an admin, he is redirected back to dashboard with a message telling him his farm will need to be approved
            return redirect(route('home'))->with('success', 'Your farm has been uploaded. Please wait for the Admin to Approve it. Thank you for choosing Farmaax');
        } else {
            //the user is an admin and he will be redirected back to the farms page
            return redirect(route('farms.index'))->with('success', 'Farm has been uploaded successfully');
        }
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
        return view('farms.show')->with(['farm' => Farm::findOrFail($id), 'layout' => $layout, 'farmPhotos' => FarmPhotos::where('farm_id', $id)->get()]);
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
        $data['farms'] = DB::table('farms')
        ->join('categories', "farms.farm_type", "=", "categories.id")
        // ->join('categories', "farms.farm_category","=","categories.id")
        ->select('farms.*', 'categories.*', 'categories.name as farmtype', 'categories.image as typeimage', 'farms.id as farm_id')
        ->get();
    // dd( $data['farms']);
    // $data['farms']=Farm::where('approved', 1)->latest()->paginate(9);

    return view('farms.farms-setup')->with($data);
    }
    public function confirmFarmSetup(Request $request)
    {
        dd($request->all());
    }
}
