<?php

namespace App\Http\Controllers;
use DemeterChain\B;
use Illuminate\Http\Request;
use App\Brand;


class BrandController extends Controller
{
    public function addBrand(){
        return view('admin.brand.add-brand');
    }

    public function newBrand(Request $request){
        $brand = new Brand();
        $brand->brand_name          =$request->brand_name;
        $brand->brand_description   =$request->brand_description;
        $brand->publication_status  =$request->publication_status;
        $brand->save();
        return redirect()->back()->with('message','Brand Info Save Successfully');
    }
    public function manageBrand(){
        $brands = Brand::all();
        return view('admin.brand.manage-brand',[ 'brands'=>$brands ]);
    }
    public function unpublishedBrand($id){
        $brand = Brand::find($id);
        $brand->publication_status = 0;
        $brand->save();
        return redirect()->back()->with('message','Brand info Unpublished Successfully');
    }
    public function publishedBrand($id){
        $brand = Brand::find($id);
        $brand->publication_status = 1;
        $brand->save();
        return redirect()->back()->with('message','Brand info published Successfully');
    }

    public function editBrand($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit-brand',['brand'=>$brand ]);
    }
    public function updateBrand(Request $request){
        $brand = Brand::find($request->brand_id);
        $brand->brand_name          =$request->brand_name;
        $brand->brand_description   =$request->brand_description;
        $brand->publication_status  =$request->publication_status;
        $brand->save();
        return redirect()->back()->with('message','Brand Update Info Successfully');
    }

    public function deleteBrand($id){
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->back()->with('message','Brand Info Delete Successfully');

        }


}
