<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Record;
use Carbon\Carbon;
use App\BadMethodCallException;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    public function index()
    {      
        $pagination =5; 
        $data = Record::latest()->paginate(5);
        return view ('record.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }


    public function filter(Request $request){

        // $start_date = $request->input('start_date');
        // $end_date = $request->input('start_date');
        
        // $start_date = date('Y-m-d', strtotime($request->start_date));
        // $end_date  = date('Y-m-d', strtotime($request->end_date));
       
        // $start = new Carbon($request->start_date);
        // $end = new Carbon($request->end_date);
        

        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();

        $data = Record::whereBetween(
            DB::Raw("STR_TO_DATE(picking_at,'%d-%m-%Y')"), [ $start_date, $end_date]);
            // ->paginate(3);


        // dd($record);
        
        // $data= Record::whereBetween('picking_at', [$start_date, $end_date])
        // ->get();

        return view('record.index', compact('data'));
    }


   
}
