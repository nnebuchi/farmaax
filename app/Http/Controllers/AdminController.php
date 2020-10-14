<?php

namespace App\Http\Controllers;
use App\FarmCostAnalysis;
use App\Farm;
use App\Category;
use App\FarmPhotos;
use App\LandForSale;
use App\Mail\YourFarmHasBeenApproved;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    $cat = Category::findOrFail($id);

        return view('admin.cost-analysis')->with('name', $cat);
    }
    public function storeCostAnalysis(Request $request)
    {
     $data =  $request->validate([
          'clearing' => 'required',
          'weeding' => 'required',
          'seeding' => 'required',
          'transport' => 'required',
          'planting' => 'required'
       ]);
      $cost =  FarmCostAnalysis::find(1);
      if ($cost) {
    $cost->farm_type = $request->farm_type;
    $cost->clearing = $request->clearing;
    $cost->weeding = $request->weeding;
    $cost->transport = $request->transport;
    $cost->planting = $request->planting;
    $cost->seeding = $request->seeding;
    $total  = $request->clearing + $request->weeding + $request->seeding + $request->transport + $request->planting;
    $cost->total = $total;
    $cost->save();
        return redirect()->back()->with("success", 'Farm Cost Analysis has been added successfully');
      }
      else {
        $cost =  new FarmCostAnalysis();
        $cost->farm_type = $request->farm_type;

        $cost->clearing = $request->clearing;
        $cost->weeding = $request->weeding;
        $cost->transport = $request->transport;
        $cost->seeding = $request->seeding;

        $cost->planting = $request->planting;
        $total  = $request->clearing + $request->weeding + $request->seeding + $request->transport + $request->planting;
        $cost->total = $total;
        $cost->save();         
        return redirect()->back()->with("success", 'Farm Cost Analysis has been added successfully');
      }
       
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
        $layout = 'admin';
        return view('lands.create')->with('layout', $layout);
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
}
