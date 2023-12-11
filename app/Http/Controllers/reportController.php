<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\stockin;
use App\Models\StockOut;
use App\Models\stockAddTotal;
use Barryvdh\DomPDF\Facade\Pdf;
use App;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;

class reportController extends Controller
{

    public function todaygetData(Request $req){

        $search         = $req->search;
        $stocktype      = $req->stocktype;
        $stockAddTotal  = null;

        if(isset($req->stocktype) && $req->stocktype == "stockin"){

            $stockAddTotal = stockAddTotal::where("created_at", "LIKE", "%".date("Y-m-d", time())."%")->orderby("id","DESC")->get();
        }elseif(isset($req->stocktype) && $req->stocktype == "stockout"){
            $stockAddTotal = StockOut::where("created_at", "LIKE", "%".date("Y-m-d", time())."%")->orderby("id","DESC")->get();
        }

        return view("pages.report.todayReport", compact('search', 'stockAddTotal','stocktype'));
    }

    public function getTodayPDF(Request $req){

        $stockAddTotal  = null;
        $stocktype      = $req->stocktype;

        if($req->stocktype == "stockin"){
            $stockAddTotal = stockAddTotal::where("created_at", "LIKE", "%".date("Y-m-d", time())."%")->orderby("id","DESC")->get();

        }elseif($req->stocktype == "stockout"){
            $stockAddTotal = StockOut::where("created_at", "LIKE", "%".date("Y-m-d", time())."%")->orderby("id","DESC")->get();
        }

        if(isset($req->type) && $req->type == "todayDownload"){
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.pdf.stock_pdf', compact('stockAddTotal', 'stocktype'));
            return $pdf->download("StockIn-".date("d-F-Y").".pdf");

        }else{
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.pdf.stock_pdf', compact('stockAddTotal', 'stocktype'));
            return $pdf->stream();
        }

    }


    public function dateRangeReport(Request $req){

        $search        = $req->search;
        $stocktype     = $req->stocktype;
        $stockAddTotal = null;

        $startTime  = date("Y-m-d h:i:s", strtotime($req->form_date."12:00:00 am")-1);
        $endTime    = date("Y-m-d h:i:s", strtotime($req->to_date."23:59:59")+1);

        if(isset($req->stocktype) && $req->stocktype == "stockin"){
            $stockAddTotal = stockAddTotal::where("refund_status", 0)->whereBetween('created_at',[$startTime, $endTime])->orderby("id","DESC")->get();
        }elseif(isset($req->stocktype) && $req->stocktype == "stockout"){
            $stockAddTotal = StockOut::whereBetween('created_at',[$startTime, $endTime])->orderby("id","DESC")->get();

        }elseif(isset($req->stocktype) && $req->stocktype == "refund"){
            $stockAddTotal = stockAddTotal::where("refund_status", 1)->whereBetween('created_at',[$startTime, $endTime])->orderby("id","DESC")->get();
        }
        
        return view("pages.report.dateRangeReport", compact('search', 'stockAddTotal','stocktype'));
    }


    public function getDateRangePDF(Request $req){

        $stockAddTotal  = null;
        $stocktype     = $req->stocktype;

        $start = $req->start;
        $end = $req->end;

        $startTime  = date("Y-m-d h:i:s", strtotime($req->start."12:00:00 am")-1);
        $endTime    = date("Y-m-d h:i:s", strtotime($req->end."23:59:59")+1);


        if($req->stocktype == "stockin"){
            $stockAddTotal = stockAddTotal::where("refund_status", 0)->whereBetween('created_at',[$startTime, $endTime])->orderby("id","DESC")->get();

        }elseif($req->stocktype == "stockout"){
            $stockAddTotal = StockOut::whereBetween('created_at',[$startTime, $endTime])->get();
        }elseif(isset($req->stocktype) && $req->stocktype == "refund"){
            $stockAddTotal = stockAddTotal::where("refund_status", 1)->whereBetween('created_at',[$startTime, $endTime])->orderby("id","DESC")->get();
        }

        if(isset($req->type) && $req->type == "todayDownload"){

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.pdf.stock_pdf', compact('stockAddTotal', 'stocktype', 'start','end'));
            return $pdf->download("Stock-".date("d-F-Y").".pdf");

        }else{
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.pdf.stock_pdf', compact('stockAddTotal', 'stocktype', 'start','end'));
            return $pdf->stream();
        }


    }

    public function productWiseReport(Request $req){
        $search         = $req->search;
        $stocktype      = $req->stocktype;
        $product_id      = $req->product_id;
        $stockAddTotal  = null;
        $stocks = StockIn::latest()->with('brand','category','model','capacity','color','size')->get();
        if(isset($req->stocktype) && $req->stocktype == "stockin"){
            $stockAddTotal = stockAddTotal::orderby("id","DESC")->where("stockin_id", $req->product_id)->get();
        }elseif(isset($req->stocktype) && $req->stocktype == "stockout"){
            $stockAddTotal = StockOut::orderby("id","DESC")->where("stockin_id", $req->product_id)->get();
        }
        return view("pages.report.productWiseReport", compact('stocks','search','stockAddTotal','stocktype', 'product_id'));
    }



    public function productwishpdf(Request $req){

        $stockAddTotal  = null;
        $stocktype      = $req->stocktype;
        $product        = StockIn::find($req->pid);

        if($req->stocktype == "stockin"){

            $stockAddTotal = stockAddTotal::orderby("id","DESC")->where("stockin_id", $req->pid)->get();

        }elseif($req->stocktype == "stockout"){
            $stockAddTotal = StockOut::orderby("id","DESC")->where("stockin_id", $req->pid)->get();
        }

        if(isset($req->type) && $req->type == "todayDownload"){
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.pdf.productwise', compact('stockAddTotal', 'stocktype', 'product'));
            return $pdf->download("StockIn-".date("d-F-Y").".pdf");

        }else{
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadView('pages.pdf.productwise', compact('stockAddTotal', 'stocktype', 'product'));
            return $pdf->stream();
        }



    }








}
