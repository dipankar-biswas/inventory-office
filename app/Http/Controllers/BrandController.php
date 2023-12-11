<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::latest()->get();
        return view('pages.brand.brand_list',compact('brands'));
    }

    public function create(){
        return view('pages.brand.brand_add');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:brands|max:255',
        ]);

        $brand = new Brand();
        if($request->image){
            @unlink($brand->image);
            $path = $request->image;
            $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
            $path->move(public_path("upload/brand"),$paths);
            $path_url = 'upload/brand/'.$paths;
            $brand->image = $path_url;
        }
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->save();
        if($brand){
            return redirect()->route('brand.list')->with('success','Brand Add Successfully!');
        }else{
            return redirect()->back()->with('failure','Brand Not Add!');
        }
    }

    public function show($id){
        $brands = Brand::findOrFail($id);
        return view('pages.brand.brand_edit',compact('brands'));
    }


    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required|unique:brands,name,'.$id.'|max:255',
        ]);

        $brand = Brand::find($id);
        if($request->image){
            @unlink($brand->image);
            $path = $request->image;
            $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
            $path->move(public_path("upload/brand"),$paths);
            $path_url = 'upload/brand/'.$paths;
            $brand->image = $path_url;
        }
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->save();
        if($brand){
            return redirect()->route('brand.list')->with('success','Brand Update Successfully!');
        }else{
            return redirect()->back()->with('failure','Brand Not Updated!');
        }
    }

    public function destroy($id){
        $brand = Brand::find($id);
        @unlink($brand->image);
        $brand = $brand->delete();
        if($brand){
            return redirect()->route('brand.list')->with('success','Brand Delete Successfully!');
        }else{
            return redirect()->back()->with('failure','Brand Not Deleted!');
        }
    }
}
