<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(){
        return view('admin.category.add-category');
    }


    public function newCategory(Request $request){
        $this->validate($request, [
            'category_name'         =>'required|regex:/^[\pL\s\-]+$/u|max:15|min:5',
            'category_description'  =>'required',
            'publication_status'    =>'required'
        ]);
        $category = new Category();
        $category->category_name        = $request->category_name ;
        $category->category_description = $request->category_description ;
        $category->publication_status   = $request->publication_status ;
        $category->save();
        return redirect()->back()->with('message', 'Category Info Save Successfully');
    }

    public function manageCategory(){
        $categores = Category::all();
        return view('admin.category.manage-category',[ 'categores'=>$categores ]);
    }
    public function unpublishedCategory($id){
        $category = Category::find($id);
        $category->publication_status = 0;
        $category->save();
        return redirect()->back()->with('message','Category Info Unpublished');
    }

    public function publishedCategory($id){
        $category = Category::find($id);
        $category->publication_status = 1;
        $category->save();
        return redirect()->back()->with('message','Category Info published');
    }

    public function editCategory($id){
        $category = Category::find($id);
        return view('admin.category.edit-category',[ 'category'=>$category ]);

    }
    public function updateCategory(Request $request){

      $category = Category::find($request->category_id);

      $category->category_name          =$request->category_name;
      $category->category_description   =$request->category_description;
      $category->publication_status     =$request->publication_status;
      $category->save();
      return redirect()->back()->with('message','Category Info Update Successfully');

    }
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('message','Category Info Delete Successfully');
    }









}

