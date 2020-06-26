<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    
    public function index(){
        //$user = $request->user();
       // $nome = $user->name;

       //$user = Auth::user();
       

        return view('site.home');
    }

}
