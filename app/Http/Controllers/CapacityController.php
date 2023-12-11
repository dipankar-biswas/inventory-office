<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacity;
use Illuminate\Support\Str;

class CapacityController extends Controller
{
    public function index(){
        $capacities = Capacity::latest()->get();
        return view('pages.capacity.capacity_list',compact('capacities'));
    }

    public function create(){
        return view('pages.capacity.capacity_add');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:capacities|max:255',
        ]);

        $capacity = new Capacity();
        $capacity->name = $request->name;
        $capacity->slug = Str::slug($request->name);
        $capacity->save();
        if($capacity){
            return redirect()->route('capacity.list')->with('success','Capacity Add Successfully!');
        }else{
            return redirect()->back()->with('failure','Capacity Not Add!');
        }
    }

    public function show($id){
        $capacities = Capacity::findOrFail($id);
        return view('pages.capacity.capacity_edit',compact('capacities'));
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'required|unique:capacities,name,'.$id.'|max:255',
        ]);

        $capacity = Capacity::find($id);
        $capacity->name = $request->name;
        $capacity->slug = Str::slug($request->name);
        $capacity->save();
        if($capacity){
            return redirect()->route('capacity.list')->with('success','Capacity Update Successfully!');
        }else{
            return redirect()->back()->with('failure','Capacity Not Updated!');
        }
    }

    public function destroy($id){
        $capacity = Capacity::find($id);
        @unlink($capacity->image);
        $capacity = $capacity->delete();
        if($capacity){
            return redirect()->route('capacity.list')->with('success','Capacity Delete Successfully!');
        }else{
            return redirect()->back()->with('failure','Capacity Not Deleted!');
        }
    }
}
