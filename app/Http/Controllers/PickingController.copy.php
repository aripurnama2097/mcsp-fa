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
 
      
    public function storeData(Request $request){
   
    
    //     DB::beginTransaction();

    // try {
    //     // Insert or update data in table1
    //     $table1 = Compare::updateOrCreate(
       
    //         ['rog_number' => $request->rog_number, 'part_number' => $request->part_number]
    //     );

    //     return $table1;

    //     // Insert or update data in table2
    //     $table2 = RegisterPart::updateOrCreate(
  
    //         ['status' => $request->status]
    //     );

    //     return $table2;
    //     // Commit the transaction
    //     DB::commit();

    //     // Return success response
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data updated successfully'
    //     ]);
    // } catch (\Exception $e) {
    //     // Rollback the transaction
    //     DB::rollBack();

    //     // Return error response
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Error updating data: ' . $e->getMessage()
    //     ]);
    // }



    $data = $request->all();

    // Check if the record exists in the first table
    $record = Compare::where('id', $data['id'])->first();
    if ($record) {
        // Update the record
        $record->update($data);
    } else {
        // Insert a new record
        Compare::create($data);
    }

    // Check if the record exists in the second table
    $record = RegisterPart::where('id', $data['id'])->first();
    if ($record) {
        // Update the record
        $record->update($data);
    } else {
        // Insert a new record
        RegisterPart::create($data);
    }

    }   

}

