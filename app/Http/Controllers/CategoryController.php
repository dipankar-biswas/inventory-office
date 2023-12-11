<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('pages.category.category_list',compact('categories'));
    }

    public function create(){
        return view('pages.category.category_add');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        if($request->image){
            @unlink($category->image);
            $path = $request->image;
            $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
            $path->move(public_path("upload/category"),$paths);
            $path_url = 'upload/category/'.$paths;
            $category->image = $path_url;
        }
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        if($category){
            return redirect()->route('category.list')->with('success','category Add Successfully!');
        }else{
            return redirect()->back()->with('failure','category Not Add!');
        }
    }

    public function show($id){
        $categories = Category::findOrFail($id);
        return view('pages.category.category_edit',compact('categories'));
    }
    
    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$id.'|max:255',
        ]);

        $category = Category::find($id);
        if($request->image){
            @unlink($category->image);
            $path = $request->image;
            $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
            $path->move(public_path("upload/category"),$paths);
            $path_url = 'upload/category/'.$paths;
            $category->image = $path_url;
        }
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        if($category){
            return redirect()->route('category.list')->with('success','category Update Successfully!');
        }else{
            return redirect()->back()->with('failure','category Not Updated!');
        }
    }

    public function destroy($id){
        $category = Category::find($id);
        @unlink($category->image);
        $category = $category->delete();
        if($category){
            return redirect()->route('category.list')->with('success','Category Delete Successfully!');
        }else{
            return redirect()->back()->with('failure','Category Not Deleted!');
        }
    }
}
