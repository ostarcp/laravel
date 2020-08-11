<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('backend.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.categories.add-cate');
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
         
        $data = request()->validate(
            [
                'cate_name' => 'required|unique:categories|alpha'
            ],
            [
                'cate_name.required' => 'Hãy nhập tên thể loại',
                'cate_name.unique' => 'Thể loại này đã tồn tại',
                'cate_name.alpha' => 'Chỉ được nhập chữ cái alphabet'
            ]
        );

        $cate = new Category();

        $cate->create([
            'cate_name' => $data['cate_name'],
        ]);

        return redirect('/admin/categories')->with('status','Category Added!');
    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $cate = $category;
        return view('backend.categories.edit-cate',compact('cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(Gate::denies('edit')){
            abort(403,'Bạn ko có quyền này nhé');       
        }

        $data = request()->validate(
            [
                'cate_name' => 'required|alpha'
            ],
            [
                'cate_name.required' => 'Hãy nhập tên thể loại',           
                'cate_name.alpha' => 'Chỉ được nhập chữ cái alphabet'
            ]
        );


        $category->update(array_merge(
            $data,
        ));

        return redirect('/admin/categories')->with('status','Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Gate::denies('delete')){
            // return redirect()->route('admin.users.index');
            abort(403,'Bạn ko có quyền này nhé ');
         }

        $category->delete();
        return redirect()->route('admin.categories.index')->with('status','Deleted!');
    }
}
