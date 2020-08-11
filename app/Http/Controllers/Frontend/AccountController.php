<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Product;
use App\Category;
use App\User;
use App\Order;

class AccountController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function account(){
        $account = User::where('id', auth()->id())->first();
        $categories = Category::all();
        return view('frontend.accounts.main-account',compact('account','categories'));  
    }

    public function accountOrderDetail(Order $order){
        $categories = Category::all();
        return view('frontend.accounts.account-bill-detail',compact('order','categories'));  
    }

    public function updateAccount(User $account){
        
            $data = request()->validate([
                'name' => ['required','regex:/^[\pL\s\-]+$/u'],
                'avatar' => 'image',
                'address' => '',
                'phone' => ['regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            ],
        );

        if(request('avatar')){
            $imagePath = request('avatar')->store('uploads','public');
            $imageArray = ['avatar'=>$imagePath];
         }

         $account->update(array_merge(
            $data,
            $imageArray ?? [],
        ));

        return redirect('/account')->with('status','Account Updated!');

    }

  

  

    public function changePassword(Request $request){
        
        $data = request()->validate([
            'old_password' => 'required',    
            'new_password' => 'min:6|required_with:confirm_new_password',
            'confirm_new_password' => 'min:6|same:new_password'
        ]);
        

        if (!Hash::check($data['old_password'], Auth::user()->password)) {
            return back()->withErrors(['old_password' => ['Your old password does not match!']]);

        }else{
            $user = Auth::user();
            $user->password = bcrypt($data['new_password']);
            $user->save();
            return redirect('/account')->with('status','Password Updated!');
        }
         
    }
}
