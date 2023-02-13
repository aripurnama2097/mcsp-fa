<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\RecordSorting;
use Carbon\Carbon;
use App\BadMethodCallException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RecordExport;

class RecordController extends Controller
{
    public function index(Request $request)
    {      

        // $date = $request->input('start_date');
        // $date2 = $request->input('end_date');

        $pagination =5; 
        $data = RecordSorting::latest()->paginate(5);
        return view ('record.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }


    public function filter(Request $request){

        $date = $request->input('start_date');
        $date2 = $request->input('end_date');


        // $data = RecordSorting::whereBetween('shorting_date', [$date,$date2])->get();

        $data = DB::table('split_Label')
        ->whereDate('shorting_date','>=', $date)
        ->whereDate ('shorting_date','<=', $date2)
        ->get();
         return response()->json($data);
    }

    public function exportCSV(Request $request) 
    {
        // return $request;
        $start_date = $request->input('start_date');
        $end_date =  $request->input('end_date');
        // $data = RecordSorting::whereBetween('shorting_Date', [$start_date, $end_date])->get();
        $data = DB::table('split_Label')
        ->whereDate('shorting_date','>=',  $start_date)
        ->whereDate ('shorting_date','<=',   $end_date)
        ->get();
        
        return Excel::download(new RecordExport($data), 'filtered_data.csv');
    }

    // public function show($id)
    // {
    //     $record = RecordSorting::find($id);
    //     return view('record.show', ['record' => $record]);
    // }
   
}
