<?php

namespace App\Http\Controllers;

use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function pages($pagename){

    	 $data['farms'] = DB::select("SELECT * FROM categories WHERE parent>0");


		$data['page'] = Pages::where('name', $pagename)->first();

    	  // = DB::select("SELECT * FROM pages WHERE name = '$pagename'");

    	return view('pages.'.$pagename)->with($data);
    }
    
  
}
