<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    public function index(){
        $colors = Color::latest()->get();
        return view('pages.color.color_list',compact('colors'));
    }

    public function create(){
        return view('pages.color.color_add');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:colors|max:255',
        ]);

        $color = new Color();
        $color->name = $request->name;
        $color->slug = Str::slug($request->name);
        $color->save();
        if($color){
            return redirect()->route('color.list')->with('success','Color Add Successfully!');
        }else{
            return redirect()->back()->with('failure','Color Not Add!');
        }
    }

    public function show($id){
        $colors = Color::findOrFail($id);
        return view('pages.color.color_edit',compact('colors'));
    }

    public function edit(){
        return 'edit';
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required|unique:colors|max:255',
        ]);

        $color = Color::find($id);
        $color->name = $request->name;
        $color->slug = Str::slug($request->name);
        $color->save();
        if($color){
            return redirect()->route('color.list')->with('success','Color Update Successfully!');
        }else{
            return redirect()->back()->with('failure','Color Not Updated!');
        }
    }

    public function destroy($id){
        $color = Color::find($id);
        $color = $color->delete();
        if($color){
            return redirect()->route('color.list')->with('success','Color Delete Successfully!');
        }else{
            return redirect()->back()->with('failure','Color Not Deleted!');
        }
    }
}
