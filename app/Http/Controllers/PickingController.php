<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picking; // table register_part
use App\Models\Compare; // table picking
use App\Models\Sorting;
use App\Models\RegisterPart; // table register_part
use Illuminate\Support\Facades\DB;

class PickingController extends Controller
{
    public function index()
    {      
        $pagination =5; 
        $data = RegisterPart::latest()->paginate(5);
        return view ('picking.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }

    public function detail($id){
        $data = RegisterPart::where('id', $id)->get();  
        
        return view ('picking.detail',
        compact('data'));
    }

    public function resultCompare()
    { 
    // SEND DATA TO LIST SORTING
        $data = Compare::orderBy('id')
        ->where('id')->get();
        // ->where('part_number')->get();
        return response()->json($data);   
    }
 
    public function storeData(Request $request){
        // return $request;

        // part_number => "A6C-111-22"
        // picking_by => "41312"
        // rog_number => "ROG123"
        // scan_label => "A2B-0128-20     1234567 40    I10827 A2B-0002-00    202211161618210132000030"
        // status => "SELECT"

        $update_status = "PICKING";
        $label_qty= substr("A2B-0128-20     1234567 40    I10827 A2B-0002-00    202211161618210132000030",23,3);

        RegisterPart::where("status",$request->status)
        ->where("part_number",$request->part_number)
        ->where("rog_number",$request->rog_number)
        ->update(["status" => $update_status]);
        // DB::beginTransaction();
        
        // $picking = new Picking;

        // return $data;

        // try{

           $data= DB::table('picking')->insert([
                'rog_number'=>$request->rog_number,
                'part_number'=>$request->part_number,
                'status'=>$update_status,
                'picking_by'=>$request->picking_by,
                'scan_label'=>$request->scan_label,
                'qty_scan'=>$label_qty,
                
            ]);       

            return [
                "success" => true
            ];

            // return response()->json($data);
          

        //     $model = DB::table('register_part')
        //     // ->where('id',8)
        //     ->where('status','SELECT')
        //     ->update(['status' => 'PICKING']);
           
        //     return $model;

        //     // UPDATE TABLE REGISTER
           
        //     // $data = RegisterPart::find($request->id);
        //     // $data->status = 'PICKING';            
        //     // $data->save();


        //     //     
    
        // // }

        // // catch (\Exception $e) {
        // //             // Rollback the transaction
        // //             DB::rollBack();
            
        // //             // Return error response
        // //             return response()->json([
        // //                 'success' => false,
        // //                 'message' => 'Error updating data: ' . $e->getMessage()
        // //             ]);

        // // }
        
          
    }         
      


}   



