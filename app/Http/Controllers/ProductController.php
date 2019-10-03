<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $categories = Category::where('publication_status', 1)->get();
        $brands     = Brand::where('publication_status', 1)->get();
        return view('admin.product.add-product',[
            'categories' => $categories,
            'brands'     => $brands
        ]);
    }
    protected function productInfoValidation($request){
        $this->validate($request,[
        'category_id'       =>'required',
        'brand_id'          =>'required',
        'product_name'      =>'required',
        'product_price'     =>'required',
        'product_quantity'  =>'required',
        'short_description' =>'required',
        'long_description'  =>'required',
        'product_image'     =>'required',
        'publication_status'=>'required'
    ]);
    }
    protected function productImageUpdoad($request){
        $productImage = $request->file('product_image');
        $imageName    = $productImage->getClientOriginalName();
        $directory    = 'product-image/';
        $imageUrl     =$directory.$imageName;
        $productImage->move($directory,$imageName);
        return $imageUrl;
    }
    public function saveProductInfo(Request $request){
       $this->productInfoValidation($request);
       $imageUrl = $this->productImageUpdoad($request);
       $product = new product();
       $product->category_id        =$request->category_id;
       $product->brand_id           =$request->brand_id;
       $product->product_name       =$request->product_name;
       $product->product_price      =$request->product_price;
       $product->product_quantity   =$request->product_quantity;
       $product->short_description  =$request->short_description;
       $product->long_description   =$request->long_description;
       $product->product_image      =$imageUrl;
       $product->publication_status =$request->publication_status;
       $product->save();
       return redirect()->back()->with('message','Product Info Save Successfully');

    }
    public function manageProductInfo(){
    $products = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->select('products.*', 'categories.category_name', 'brands.brand_name')
                ->get();
    return view('admin.product.manage-product',['products'=> $products ]);
}

    public function editProductInfo($id){
         $product    = Product::find($id);
         $categories = Category::where('publication_status', 1)->get();
         $brands     = Brand::where('publication_status', 1)->get();
         return view('admin.product.edit-product',[
             'product'   => $product,
             'categories'=> $categories,
             'brands'    => $brands
         ]);
    }
    public function productBasicInfoUpdate($product,$request,$imageUrl){
        $product->category_id        =$request->category_id;
        $product->brand_id           =$request->brand_id;
        $product->product_name       =$request->product_name;
        $product->product_price      =$request->product_price;
        $product->product_quantity   =$request->product_quantity;
        $product->short_description  =$request->short_description;
        $product->long_description   =$request->long_description;
        if ($imageUrl){
            $product->product_image  =$imageUrl;
        }

        $product->publication_status =$request->publication_status;
        $product->save();
    }

    public function updateProductInfo(Request $request){
        $productImage =  $request->file('product_image');
        $product      = Product::find($request->id);
      if ($productImage) {
          unlink($product->product_image);
          $imageUrl = $this->productImageUpdoad($request);
          $this->productBasicInfoUpdate($product,$request,$imageUrl);
      }else{
          $this->productBasicInfoUpdate($product,$request);
      }
        return redirect()->back()->with('message','Product Info Update Successfully');
    }

}
