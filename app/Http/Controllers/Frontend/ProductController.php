<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\User;
use App\Comments;
use Gate;
class ProductController extends Controller
{

    public function shopPage($id = []){

        $categories = Category::all();

        if($id){
            $products = Product::where('cate_id',$id)->paginate(9);
        }else{
            $products = Product::paginate(9);
          
        }
       
        return view('frontend.shop',compact('products','categories'));  
    }

    public function productPage(Product $product)
    {
        $categories = Category::all();
        //$user = User::find(auth()->id());
        $comment = Comments::all();
        $productDetail = $product;
        $relativePD = Product::where('cate_id',$product->cate_id)
        ->where('id','!=',$product->id)
        ->orderByRaw("RAND()")
        ->paginate(4);

        return view('frontend.detail',compact('productDetail','categories','relativePD','comment'));  
    }

    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categories = Category::all();
        $products = Product::where('name','LIKE',"%$query%")->get();
        return view('frontend.search',compact('categories','products'));  
    }
    

    public function comment(Request $request, Product $product){
        $data = request()->validate([
            'name' => 'required',
            'content_cmt' => 'required',
        ]);

        $comment = Comments::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'content' => $data['content_cmt'],
        ]);

       return back()->with('status','oke');
    }

    public function deleteCMT(Comments $comment){
        if(Gate::denies('delete-comment',$comment)){
            abort(403,'Bạn ko có quyền này nhé ');
         }

        $comment->delete();
        return back()->with('status','Deleted!');
    }

    public function loadcomment(){
    
    }

}
