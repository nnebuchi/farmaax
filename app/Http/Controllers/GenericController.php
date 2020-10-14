<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\State;
use App\Lga;
use App\Town;
class GenericController extends Controller
{
    public function fetchFarmTypes(Request $request, $Category_id){
    	$farmtpes=Category::where('id', $Category_id)->get();

    	echo json_encode($farmtpes);
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
