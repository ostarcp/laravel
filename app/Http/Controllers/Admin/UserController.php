<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(){
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $users = User::where('id','!=',auth()->id())->get();
        $users = User::all();
        return view('backend.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.users.add-user',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('add')){
            
            abort(403,'Bạn ko có quyền');
         }

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'min:6|required_with:password_confirmation',
            'password_confirmation' => 'min:6|same:password',
            'avatar' => 'image',
            'address' => 'required',
            'phone' => ['required','regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
            'roles' => ''
        ]);

        if(request('avatar')){
            $imagePath = request('avatar')->store('uploads','public');
        }
        $imagePath = '';
        // dd($data);
        

        $user = User::create([
            'name' => $data['name'],
            'email' =>$data['email'],
            'password' =>  Hash::make($data['password']),
            'avatar' => $imagePath,
            'phone' => $data['phone'],
            'address' => $data['address'],
         ]);

         $roleId = $data['roles'];

         $role = Role::select('id')->where('id', $roleId)->first();

         $user->roles()->attach($role);
    
         return redirect('/admin/users')->with('status','User Added!');
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   

        if(Gate::denies('edit')){
           // return redirect()->route('admin.users.index');
           abort(403,'Bạn ko có quyền');
        }

        $roles = Role::all();

        return view('backend.users.edit-user',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Gate::denies('edit')){
            return redirect()->route('admin.users.index');           
         }

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'avatar' => '',
            'address' => '',
            'phone' => ['regex:/((09|03|07|08|05)+([0-9]{8})\b)/'],
        ],
    );

       
        if(request('avatar')){
            $imagePath = request('avatar')->store('uploads','public');
            $imageArray = ['avatar'=>$imagePath];
         }
        // 

        $user->roles()->sync($request->roles);

        //dd($user->password);

         $user->update(array_merge(
             $data,
            //  ['password' =>  Hash::make($data['password'])],
             $imageArray ?? [],
         ));

         return redirect('/admin/users')->with('status','User Updated!');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete')){
           // return redirect()->route('admin.users.index');
           abort(403,'Bạn ko có quyền');
        }
        //dd($user);
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index')->with('status','Deleted!');
    }
}
