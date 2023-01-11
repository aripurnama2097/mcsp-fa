<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\RecordSorting;
use Carbon\Carbon;
use App\BadMethodCallException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RecordController extends Controller
{
    public function index()
    {      
        $pagination =5; 
        $data = RecordSorting::latest()->paginate(5);
        return view ('record.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }


    public function filter(Request $request){

        $date = $request->input('start_date');
        $date2 = $request->input('end_date');

       
        // $start = new Carbon($request->start_date);
        // $end = new Carbon($request->end_date);
        

        // $data = DB::table('picking')
        //     ->whereBetween('timestamp_column', [$start_date, $end_date])
      

        $data = RecordSorting::whereBetween('shorting_date', [$date,$date2])->get();
           
        // $data = collect($data);
        // Excel::create('filename', function($excel) use($data) {
        //     $excel->sheet('Sheet 1', function($sheet) use($data) {
        //         $sheet->fromArray($data);
        //     });
        // })->download('csv');

            return response()->json($data);
    }


   
}
