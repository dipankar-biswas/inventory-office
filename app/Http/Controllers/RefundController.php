<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Capacity;
use App\Models\Category;
use App\Models\Color;
use App\Models\Modele;
use App\Models\Size;
use App\Models\stockAddTotal;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RefundController extends Controller
{
    public function index(){
        $refunds = stockAddTotal::where('refund_status',1)->latest()->with("stockin")->get();
        return view('pages.refund.refund_list',compact('refunds'));
    }

    public function create(){
        $refunds = StockIn::latest()->with('brand','category','model','capacity','color','size')->get();
        return view("pages.refund.refund_add", compact('refunds'));
    }    

    public function refundStockadd(Request $request){
        for ($i=0; $i < count($request->stockinid) ; $i++) {
            $stockIn = StockIn::findOrFail($request->stockinid[$i]);
            $stockIn->qty = $stockIn->qty + $request->Qty[$i];
            $stockIn->save();

            $stockAddTotal = new stockAddTotal();
            $stockAddTotal->stockin_id   = $request->stockinid[$i];
            $stockAddTotal->qty          = $request->Qty[$i];
            $stockAddTotal->refund_status          = 1;
            $stockAddTotal->save();

        }

        if($stockAddTotal){
            Session::put("success","Refund is successfully!");
            return response()->json([
                "status"=>"reload"
            ]);

        }else{
            Session::put("error","Refund not success!");
            return response()->json([
                "status"=>"reload"
            ]);
        }
    }
}
