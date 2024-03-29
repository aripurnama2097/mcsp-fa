<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartPicking; // table register_part
use App\Models\Compare; // table picking
use App\Models\Sorting;
use App\Models\PartSorting;
use App\Models\RegisterPart; // table register_part
use Illuminate\Support\Facades\DB;

class PickingController extends Controller
{
    public function index()
    {      
        $pagination =8; 
        $data = RegisterPart::latest()->paginate(8);

        $get_location= DB::connection('sqlsrv')
        ->select('SELECT d.id, d.rog_number, d.part_number, c.partname, b.lokasi, b.input_date
        from MCSORTING.dbo.register_part as d
        left join 
        (
        select a.partnumber, a.partname,  max(a.replikasi) as replikasi
        from SVRDBN.EDI.dbo.StdPack  a
        group by a.partnumber, a.partname
        ) as c on d.part_number COLLATE Latin1_General_CI_AS = c.partnumber COLLATE Latin1_General_CI_AS
        left join  SVRDBN.EDI.dbo.StdPack b on b.replikasi = c.replikasi
        order by d.id desc');
 

        return view ('picking.index',compact('data','get_location'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }


    
    public function detail($id){
        $data = RegisterPart::where('id', $id)->get();  
        
        return view ('picking.detail',
        compact('data'));
    }

    public function resultCompare()
    { 
        $data = Compare::orderBy('id')->get();
        return response()->json($data);

        // $data = DB::table('part_sorting')->where('id', $id)->first();
        // return response()->json($data);
    }
 
    public function storeData(Request $request){
    
        $update_status      = "SORTING";
        $raw_nik          = $request->picking_by;
        $nik              =  substr($raw_nik, 2,5); 
        $labelQty         = $request->scan_label;
        $label_qty        = substr($labelQty, 23,3);

        RegisterPart::where("status",$request->status)
        ->where("part_number",$request->part_number)
        ->where("rog_number",$request->rog_number)
        ->update(["status" => $update_status]);

            // INSERT INTO PICKING 
        //    DB::table('picking')->insert([
        //         'rog_number'=>$request->rog_number,
        //         'part_number'=>$request->part_number,
        //         'status'=>$update_status,
        //         'picking_by'=>$nik,
        //         'scan_label'=>$request->scan_label,
        //         'qty_scan'=>$label_qty,
                
        //     ]);      
            
           
        // INSERT INTO PART SORTING AFTER SUCCESS COMPARE
         DB::table('part_sorting')->insert([
            'rog_number'=>$request->rog_number,
            'part_number'=>$request->part_number,
            'status'=>$update_status,
            // 'picking_by'=>$nik,
            'scan_label'=>$request->scan_label,
            'qty_scan'=>$label_qty,
            'qty_request'=>$request->qty_request,
       
            
        ]);     
        
        $resultPicking = 'OK';

        $param = [
            "part_picking_id" => $request->id,
            // "picking_by" => $nik,
            "rog_number" => $request->rog_number,
            "part_number" => $request->part_number,
            "scan_label" => $request->scan_label,
            "qty_scan" =>  $label_qty,  
            "status" => $resultPicking,   
        ];

            return [        
                "param" => $param,       
                ];
    }         
}   



