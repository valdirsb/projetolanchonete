<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {

        $user = Auth::user();
        
        return view('site.user', ['user' => $user]);
        
    }

    public function loginoptions() {
        
        return view('site.loginoptions');
        
    }
}
