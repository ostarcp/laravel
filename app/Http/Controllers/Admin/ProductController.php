<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\ProductImages;
use App\Category;
use Gate;
use Illuminate\Http\Request;


class ProductController extends Controller
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
        $products = Product::paginate(5);
        return view('backend.products.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories = Category::all();
         return view('backend.products.add-product',compact('categories'));
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
            'cate_id'=> 'required|numeric',
            'image' => 'required|image',
            'price' => 'required|numeric',
            'sale' => 'required|numeric',
            'short_description' =>'required|max:300',
            'description' => 'required',
            'amount' => 'required|numeric',
            'tt'=> 'required',
        ]);

       // dd($data);

        $imagePath = request('image')->store('uploads','public');

        Product::create([
            'name' => $data['name'],
            'cate_id' => $data['cate_id'],
            'image' => $imagePath,
            'price' => $data['price'],
            'sale' => $data['sale'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'amount' => $data['amount'],
            'tt' => $data['tt'],
        ]);

        return redirect('/admin/products')->with('status','Product Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function show(Product $product)
    // {
    //     //
    // }

    public function show(Product $product)
    {
        return view('backend.products.upload-image-pd',compact('product'));
    }

    public function upload(Product $product)
    {
        //dd(request('small_images'));
        $data = request()->validate([
            'small_images' => 'required',
            'small_images.*' => 'image|max:2000',
            
          
        ],
        [
            'small_images.*.image' => 'Only jpeg, png, jpg images are allowed',
            'small_images.*.max' => 'Sorry! Maximum allowed size for an image is 2MB',
        ]);


         $photos = $data['small_images'];
        //dd($photos);

        foreach ($photos as $photo){
           $imagePath = $photo->store('uploads','public'); 
           ProductImages::create([
               'product_id' => $product->id,
               'small_image' => $imagePath,
           ]);
        }

        return redirect()->route('admin.products.show',$product->id)->with('status', 'Photo Added!');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        // if(Gate::denies('edit')){
        //     abort(403,'Bạn ko có quyền này nhé ');
        //  }
        $categories = Category::all();
        return view('backend.products.edit-product',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if(Gate::denies('edit')){
            abort(403,'Bạn ko có quyền này nhé ');
         }
        $data = request()->validate([
            'name' => 'required',
            'cate_id'=> 'required',
            'image' => 'image',
            'price' => 'required|numeric',
            'sale' => 'numeric',
            'short_description' =>'required|max:300',
            'description' => 'required',
            'amount' => 'required|numeric',
            'tt'=> 'required',
        ]);

        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $imageArray = ['image'=>$imagePath];
        }

        $product->update(array_merge(
            $data,
            // Neu co hoac ko co anh
            $imageArray ?? [],
            
        ));

        //return redirect('/admin/products')->with('status', 'Updated!');
        return back()->with('status', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(Gate::denies('delete')){
            abort(403,'Bạn ko có quyền này nhé ');
         }
        $product->delete();
        return redirect()->route('admin.products.index')->with('status','Deleted!');
    }


    public function destroyImages(ProductImages $pd)
    {
        if(Gate::denies('delete')){
            abort(403,'Bạn ko có quyền này nhé ');
         }

        
        
        $pd->delete();
         return redirect('/admin/products/'.$pd->product_id)->with('status','Deleted!');
    }
}

