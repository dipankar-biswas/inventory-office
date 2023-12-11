<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('pages.product.product_list',compact('products'));
    }

    public function create(){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('pages.product.product_add',compact('brands','categories'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'brand_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|max:255',
            'price' => 'required',
            'stock' => 'required',
            // 'sale_qty' => 'required',
            'color' => 'required',
            'size' => 'required',
        ]);

        $product = new Product();
        if($request->image){
            @unlink($product->image);
            $path = $request->image;
            $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
            $path->move(public_path("upload/product"),$paths);
            $path_url = 'upload/product/'.$paths;
            $product->image = $path_url;
        }
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->save();
        if($product){
            return redirect()->route('product.list')->with('success','Product Add Successfully!');
        }else{
            return redirect()->back()->with('failure','Product Not Add!');
        }
    }

    public function show($id){
        $products = Product::findOrFail($id);
        return view('pages.product.product_edit',compact('products'));
    }

    public function edit(){
        return 'edit';
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'brand_id' => 'required',
            'category_id' => 'required',
            'name' => 'required|max:255',
            'price' => 'required',
            'stock' => 'required',
            // 'sale_qty' => 'required',
            'color' => 'required',
            'size' => 'required',
        ]);

        $product = Product::find($id);
        if($request->image){
            @unlink($product->image);
            $path = $request->image;
            $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
            $path->move(public_path("upload/product"),$paths);
            $path_url = 'upload/product/'.$paths;
            $product->image = $path_url;
        }
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->color = $request->color;
        $product->size = $request->size;
        if($product){
            return redirect()->route('product.list')->with('success','Product Update Successfully!');
        }else{
            return redirect()->back()->with('failure','Product Not Updated!');
        }
    }

    public function destroy($id){
        $product = Product::find($id);
        @unlink($product->image);
        $product = $product->delete();
        if($product){
            return redirect()->route('product.list')->with('success','Product Delete Successfully!');
        }else{
            return redirect()->back()->with('failure','Product Not Deleted!');
        }
    }
}
