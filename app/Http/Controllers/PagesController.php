<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function pages($pagename){

    	$data['farms']=DB::table('farms')
                    ->join('categories', "farms.farm_type","=","categories.id")
                    // ->join('categories', "farms.farm_category","=","categories.id")
                    ->select('farms.*','categories.*', 'categories.name as farmtype','categories.image as typeimage')
                    ->get();

    	return view('pages.'.$pagename)->with($data);
    }
    
  
}
