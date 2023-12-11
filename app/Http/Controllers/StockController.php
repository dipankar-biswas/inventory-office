<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Capacity;
use App\Models\Category;
use App\Models\Color;
use App\Models\Modele;
use App\Models\Size;
use App\Models\StockIn;
use App\Models\stockAddTotal;
use App\Models\StockOut;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class StockController extends Controller
{
    public function index(){
        $stocks = StockIn::latest()->with('brand','category','model','capacity','color','size','stockaddtotal')->get();
        return view('pages.stock.stock_list',compact('stocks'));
    }

    public function create(){
        $models = Modele::latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $capacities = Capacity::latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();
        return view('pages.stock.stock_add',compact('models','brands','categories','capacities','colors','sizes'));
    }

    public function store(Request $request){
        
        $errors = Validator::make($request->all(),[
            "name" => "required",
            "category_id" => "required",
            "brand_id" => "required",
            "color_id" => "required",
            "qty.*" => "required|numeric|min:1"
        ],[
            "name.required"           => "The name field must not be empty.",
            "category_id.required"    => "The category field must not be empty.",
            "brand_id.required"       => "The brand field must not be empty.",
            "color_id.required"       => "The color field must not be empty.",
            "qty.*.required"          => "The qty field must not be empty.",
            "qty.*.numeric"           => "The qty field must be a number.",
            "qty.*.min"               => "The qty field must be at least 1.",
        ]);

        if ($errors->fails()) {
            return response()->json([
                "status" => false,
                "message" => "error",
                "data" => $errors->errors()
            ]);
        }

        for ($i=0; $i < count($request->qty); $i++) {

            $stock = new StockIn();
            $stock->name        = $request->name;
            $stock->category_id = $request->category_id;
            $stock->brand_id    = $request->brand_id;
            $stock->color_id    = $request->color_id;
            $stock->model_id    = $request->model_id;
            $stock->qty         = $request->qty[$i];
            $stock->size_id     = $request->size_id[$i];
            $stock->capacity_id = $request->capacity_id[$i];
            $stock->slug        = Str::slug($request->name[$i]);

            if (isset($request->image[$i])) {
                $path = $request->image[$i];
                $paths = substr(md5(time()+$i), 0, 10).".".$path->getClientOriginalExtension();
                $path->move(public_path("upload/stock"),$paths);
                $path_url = 'upload/stock/'.$paths;
                $stock->image = $path_url;
            }

            $stock->save();

            $stockAddTotal              = new stockAddTotal();
            $stockAddTotal->stockin_id  = $stock->id;
            $stockAddTotal->qty         = $request->qty[$i];
            $stockAddTotal->save();

        }

        if($stock){
            Session::put("success","Stock Add Successfully!");
            return response()->json([
                "status" => "reload"
            ]);
        }else{
            Session::put("error","Stock Not Add!");
            return response()->json([
                "status" => "reload"
            ]);            
        }
    }

    public function show($id){
        $models = Modele::latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $capacities = Capacity::latest()->get();
        $colors = Color::latest()->get();
        $sizes = Size::latest()->get();
        $stocks = StockIn::findOrFail($id);
        return view('pages.stock.stock_edit',compact('stocks','models','brands','categories','capacities','colors','sizes'));
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'brand_id' => 'required',
            'category_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'name' => 'required|max:255'
        ]);

        $stock = StockIn::find($id);
        if($request->image){
            @unlink($stock->image);
            $path = $request->image;
            $paths = substr(md5(time()), 0, 10).".".$path->getClientOriginalExtension();
            $path->move(public_path("upload/stock"),$paths);
            $path_url = 'upload/stock/'.$paths;
            $stock->image = $path_url;
        }


        $stock->model_id        = $request->model_id;
        $stock->brand_id        = $request->brand_id;
        $stock->category_id     = $request->category_id;
        $stock->capacity_id     = $request->capacity_id;
        $stock->color_id        = $request->color_id;
        $stock->size_id         = $request->size_id;
        $stock->name            = $request->name;
        $stock->slug            = Str::slug($request->name);
        $stock->qty             = $request->qty;
        $stock->save();

        if($stock){
            return redirect()->route('stock.list')->with('success','Stock Update Successfully!');
        }else{
            return redirect()->back()->with('failure','Stock Not Updated!');
        }



    }

    public function destroy($id){
        $stock = StockIn::find($id);
        @unlink($stock->image);
        $stock = $stock->delete();
        if($stock){
            return redirect()->route('stock.list')->with('success','Stock Delete Successfully!');
        }else{
            return redirect()->back()->with('failure','Stock Not Deleted!');
        }
    }





    // Stock Out Functin
    public function stockoutList(){
        $stockout = StockOut::latest()->with("stockin")->get();
        return view('pages.stockout.stockout_list',compact('stockout'));
    }


    public function stockoutAll(){
        $stocks = StockIn::where('qty','>',0)->latest()->with('brand','category','model','capacity','color','size','stockqtydata')->get();
        return view('pages.stockout.stockout_all',compact('stocks'));
    } 


    public function stockoutbydata(Request $request){

        $stockIn = StockIn::find($request->id);

        $totalStockIn   = 0;
        $totalStockOut  = 0;

        

        foreach($stockIn->stockaddtotal as $data){
            $totalStockIn += $data->qty;
        }        

        foreach($stockIn->stockout as $data){
            $totalStockOut += $data->qty;
        }

        $currentStock   = $totalStockIn - $totalStockOut;

        if(StockIn::where("id", $request->id)->count() > 0){
            return response()->json([
                "status" => true,
                "data" => $stockIn,
                "brand" => isset($stockIn->brand->name) ? $stockIn->brand->name : "N/A",
                "color" => isset($stockIn->color->name) ? $stockIn->color->name : "N/A",
                "size" =>  isset($stockIn->size->name) ? $stockIn->size->name : "N/A",
                "currentStock" => $currentStock
            ]);
        }else{
            return response()->json([
                "status" => false,
                "data" => null
            ]);
        }
    }    


    public function stockoutstore(Request $request){
        $errors = Validator::make($request->all(),[
            "Qty.*" => "required|min:1",
        ],[
            "Qty.*.required" => "The qty field must not be empty.",
        ]);

        if ($errors->fails()) {
            return response()->json([
                "status" => false,
                "message" => "error",
                "data" => $errors->errors()
            ]);
        }


        for ($i=0; $i < count($request->stockinid) ; $i++) {
            $stockIn = StockIn::findOrFail($request->stockinid[$i]);
            $stockIn->qty = $stockIn->qty - $request->Qty[$i];
            $stockIn->save();

            $stockOut = new StockOut();
            $stockOut->stockin_id   = $request->stockinid[$i];
            $stockOut->qty          = $request->Qty[$i];
            $stockOut->save();

        }

        if($stockOut){
            Session::put("success","Stoct Out Successfully!");
            return response()->json([
                "status"=>"reload"
            ]);

        }else{
            Session::put("error","Stoct Out Not Success!");
            return response()->json([
                "status"=>"reload"
            ]);
        }
    }

    public function extrastockadd(){
        $stocks = StockIn::latest()->with('brand','category','model','capacity','color','size')->get();
        return view("pages.addstock.stockadd", compact('stocks'));
    }    


    public function extrastockinsert(Request $request){


        for ($i=0; $i < count($request->stockinid) ; $i++) {
            $stockIn = StockIn::findOrFail($request->stockinid[$i]);
            $stockIn->qty = $stockIn->qty + $request->Qty[$i];
            $stockIn->save();

            $stockAddTotal = new stockAddTotal();
            $stockAddTotal->stockin_id   = $request->stockinid[$i];
            $stockAddTotal->qty          = $request->Qty[$i];
            $stockAddTotal->save();

        }

        if($stockAddTotal){
            Session::put("success","Stoct in successfully!");
            return response()->json([
                "status"=>"reload"
            ]);

        }else{
            Session::put("error","Stoct in not success!");
            return response()->json([
                "status"=>"reload"
            ]);
        }


    }

    public function stockinlist(){
        $stockAddTotal = stockAddTotal::where('refund_status',0)->latest()->with("stockin")->get();
        return view('pages.addstock.stockin',compact('stockAddTotal'));
    }



}
