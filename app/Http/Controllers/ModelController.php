<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modele;
use Illuminate\Support\Str;

class ModelController extends Controller
{
    public function index(){
        $models = Modele::latest()->get();
        return view('pages.modele.model_list',compact('models'));
    }

    public function create(){
        return view('pages.modele.model_add');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:modeles|max:255',
        ]);

        $model = new Modele();
        $model->name = $request->name;
        $model->slug = Str::slug($request->name);
        $model->save();
        if($model){
            return redirect()->route('model.list')->with('success','Model Add Successfully!');
        }else{
            return redirect()->back()->with('failure','Model Not Add!');
        }
    }

    public function show($id){
        $models = Modele::findOrFail($id);
        return view('pages.modele.model_edit',compact('models'));
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'name' => 'required|max:50|unique:modeles,name,'.$id,
        ]);

        $model = Modele::find($id);
        $model->name = $request->name;
        $model->slug = Str::slug($request->name);
        $model->save();
        if($model){
            return redirect()->route('model.list')->with('success','Model Update Successfully!');
        }else{
            return redirect()->back()->with('failure','Model Not Updated!');
        }
    }

    public function destroy($id){
        $model = Modele::find($id);
        $model = $model->delete();
        if($model){
            return redirect()->route('model.list')->with('success','Model Delete Successfully!');
        }else{
            return redirect()->back()->with('failure','Model Not Deleted!');
        }
    }
}
