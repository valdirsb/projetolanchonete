<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class SiteController extends Controller
{
    
    public function index(){
        $categories = Category::all();
        $array = ['categories'=> $categories];

        return view('site.home', $array);
    }

}
