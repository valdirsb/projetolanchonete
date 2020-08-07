<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {

        $user = Auth::user();

        $order = $user->orders->whereIn('status_id', [1, 2, 3])->count();
        
        return view('site.user', [
            'user' => $user,
            'order' =>  $order
            ]);
        
    }

    public function loginoptions() {
        
        return view('site.loginoptions');
        
    }
}
