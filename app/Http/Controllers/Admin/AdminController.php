<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\ProductImages;
use App\Category;
use App\Order;
use App\Comments;
use App\User;
use Gate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function admin(){
        $userCount = User::count();
        $productCount = Product::count();
        $orderCount = Order::count();
        $commentCount = Comments::count();

        return view('backend.admin.index',compact('userCount','productCount','orderCount','commentCount'));
    }
}
