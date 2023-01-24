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
    public function index()
    {      

        $pagination =5; 
        $data = RecordSorting::latest()->paginate(5);
        return view ('record.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }


    public function filter(Request $request)
    {

        $date = $request->input('start_date');
        $date2 = $request->input('end_date');

        $data = DB::table('split_Label')
        ->whereDate('shorting_date','>=', $date)
        ->whereDate ('shorting_date','<=', $date2)
    //    ->get();
        ->get();

        // return view('record.index', compact('data'));
         return response()->json($data);


        //  $filter_date = $request->input('filter_date');
        //  $items = Item::whereDate('created_at', $filter_date)->paginate(10);
        //  return view('items.index', compact('items'));
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
        
        return Excel::download(new RecordExport($data), 'SortingRecord.csv');
    }

   
}
