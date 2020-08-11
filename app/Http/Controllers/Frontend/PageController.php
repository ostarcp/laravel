<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\User;

class PageController extends Controller
{

 

    public function index(){

        $categories = Category::all();

        $products = Product::orderBy('created_at', 'DESC')->limit(4)->get();;        
        return view('frontend.index',compact('products','categories'));  
      
    }


  
    
    public function cartPage(){
        return view('frontend.cart');  
    }

    public function contactPage(){
        return view('frontend.contact');  
    }

    public function showPd(Product $abc){
        
        return view('frontend.blog',compact('abc'));  
    }

    // public function loginPage(){
    //     return view('frontend.login');  
    // }
    // public function registerPage(){
    //     return view('frontend.register');  
    // }
}
