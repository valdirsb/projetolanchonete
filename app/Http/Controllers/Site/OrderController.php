<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {

        $user = Auth::user();

        return view('site.order', [
            'orders' => $user->orders
        ]);
    }
}
