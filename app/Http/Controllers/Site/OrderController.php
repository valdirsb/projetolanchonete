<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {

        $user = Auth::user();

        $orderProd = $user->orders->whereIn('status_id', [1, 2, 3]);
        $orderCancel = $user->orders->where('status_id', 5);
        $orderFinish = $user->orders->where('status_id', 4);

        return view('site.order', [
            'orders' => $orderProd,
            'ordercancel' => $orderCancel,
            'orderfinish' => $orderFinish
        ]);
    }
}
