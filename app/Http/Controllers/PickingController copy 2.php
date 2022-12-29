<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picking;
use App\Models\Compare;
use App\Models\Sorting;
use App\Models\RegisterPart;
use App\Http\Controllers\DBController;
use Illuminate\Support\Facades\DB;

class PickingController extends Controller
{
    public function index()
    {      
        $pagination =5; 
        $data = Picking::latest()->paginate(5);
        return view ('picking.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }

    public function detail($id){
        $data = Picking::where('id', $id)->get();  
        
        return view ('picking.detail',
        compact('data'));
    }

    public function resultCompare()
    { 
    // SEND DATA TO LIST SORTING
    $data = Compare::orderBy('id')->get();
    return response()->json($data);
  
    }
 
      
    public function storeData( Request $request){
   
   // Insert data into second table
        DB::beginTransaction();
        try{
                
            $data= DB::table('picking')->insert([
                'rog_number'=>$request->rog_number,
                'part_number'=>$request->part_number,
                'status'=>$request->status,
                'picking_by'=>$request->picking_by,
                'scan_label'=>$request->scan_label,
                
            ]);       
            return response()->json($data);
            
            // Update the first table's record
            DB::table('register_part')
            ->where('id')
            ->update([
            'status' => $request->input('status')
            ]);
        
            DB::commit();
        }

        catch (\Exception $e) {
            DB::rollBack();
            // Handle exception
        }
           
  

    // DB::table('register_part')
    // ->update([
    // 'status' => 'PICKING'

    // ]);

    //  $model =  DB::table('register_part')
    // ->find($request->id)
    //  ->where('id', $request->id)
    //  ->update([
    // 'status' => 'PICKING'
    //  ]);
         
}   

}

