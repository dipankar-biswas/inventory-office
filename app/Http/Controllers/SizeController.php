<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Str;

class SizeController extends Controller
{
    public function index(){
        $sizes = Size::latest()->get();
        return view('pages.size.size_list',compact('sizes'));
    }

    public function create(){
        return view('pages.size.size_add');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:sizes|max:255',
        ]);

        $size = new Size();
        $size->name = $request->name;
        $size->slug = Str::slug($request->name);
        $size->save();
        if($size){
            return redirect()->route('size.list')->with('success','Size Add Successfully!');
        }else{
            return redirect()->back()->with('failure','Size Not Add!');
        }
    }

    public function show($id){
        $sizes = Size::findOrFail($id);
        return view('pages.size.size_edit',compact('sizes'));
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required|unique:sizes,name,'.$id.'|max:255',
        ]);

        $size = Size::find($id);
        $size->name = $request->name;
        $size->slug = Str::slug($request->name);
        $size->save();
        if($size){
            return redirect()->route('size.list')->with('success','Size Update Successfully!');
        }else{
            return redirect()->back()->with('failure','Size Not Updated!');
        }
    }

    public function destroy($id){
        $size = Size::find($id);
        $size = $size->delete();
        if($size){
            return redirect()->route('size.list')->with('success','Size Delete Successfully!');
        }else{
            return redirect()->back()->with('failure','Size Not Deleted!');
        }
    }
}
