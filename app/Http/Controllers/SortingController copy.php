<?php

namespace App\Http\Controllers;

use App\Models\MasterEmployee;
use Illuminate\Http\Request;
use App\Models\PartSorting;
use App\Models\SplitLabel;
use App\Models\MasterPart;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\RecordSorting;
use App\Models\SupplierMaster;


class SortingControllerTest extends Controller
{

    protected $dataSplit;

    public function index()
    {      
        // $data2 = RegisterPart::where('id')->get();  
        $pagination =5; 
        $data = PartSorting::latest()->paginate(5);
        return view ('sorting.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }

    public function view($id){
        $data = PartSorting::where('id', $id)->get();

        return view ('sorting.view',
        compact('data'));
    }

    

    public function splitLabelnew(Request $request){
       

        $nik = $request->sorting_by;
        $raw_nik = substr($nik, 2,5);

        $rog_number = $request->rog_number;
        $part_number = $request->part_number;
        $qty_original = $request->qty_original;
        $qty_split = $request->qty_split;
        $status = $request->status;
        $po = isset($qty_original) ? substr($qty_original,16,7) : 0;
        $update_status ='DONE';

        $label_original = $request->label_original;


        $maxqty         = substr($qty_original, 24,5); //QTY DI LABEL ORIGINAL
        $splitqty2      = intval($maxqty) - intval( $qty_split); //LABEL BALANCE = (ORIGINAL - QTY SPLIT)
        $startlabel     = substr($qty_original, 0,24);//A2B-0002-00 1234567
        $middlelabel    = substr($qty_original, 30,22);// I10827 A2B-0002-00
        $date_temp1     = date("YmdHis");
        $microdate_temp1= microtime();
        $microdate_temp2= explode(" ",$microdate_temp1);
        $microdate      = substr($microdate_temp2[0], 2, -4);
        $date           = $date_temp1 . $microdate;
        $sequence1      = str_pad(1,6,"0", STR_PAD_LEFT);
        $sequence2      = str_pad(2,6,"0", STR_PAD_LEFT);
        $qty1           = str_pad($qty_split,5," ",STR_PAD_RIGHT);//QTY LABEL SORTING
        $qty2           = str_pad($splitqty2,5," ",STR_PAD_RIGHT);//QTY LABEL BALANCE
        $newlabel1      = $startlabel . $qty1 . ' ' . $middlelabel . $date . $sequence1;
        $newlabel2      = $startlabel . $qty2 . ' ' . $middlelabel . $date . $sequence2;
           
        $label_sorting = $newlabel1;
        $label_balance = $newlabel2;

      
        
        PartSorting::where("status",$status)
        ->where("part_number",$part_number)
        ->where("rog_number",$rog_number)
        ->update(["status" => $update_status]);
        
        // INSERT INTO splitlabel
        DB::table('split_Label')->insert([        
            'sorting_by'    => $raw_nik,
            'rog_number'    => $rog_number,
            'part_number'   => $part_number, 
            'PO'            => $po,
            'label_original'=> $label_original,
            'status'        => $update_status,
            'qty_split'     => $qty_split,
            'label_sorting' => $label_sorting,
            'label_balance' => $label_balance,
            'qty_original'  => $qty_original,
                    
        ]);   

        $param = [
            "raw_nik" => $raw_nik,
            "rog_number" => $rog_number,
            "part_number" => $part_number,
            "label_original" => $label_original,
            "qty_split" => $qty_split,
            "status" => $status,
            "po" => $po,
            "part_sorting_id" => $request->id,
            "label_sorting" => $label_sorting,
            "label_balance" => $label_balance,
            "qty_original" => $qty_original,
        ];

        $get_location = $this->get_location_part($param);
        $get_type = $this->get_type($param);
        $get_suppliername = $this->get_supplierName($param);
      
        $param['lokasi'] = $get_location;
        $param['type'] = $get_type;
        $param['supplierName'] = $get_suppliername;

        return [
            "success" => true,
            "param" => $param,
            "message" => "print"
        ];

    }
    public function get_location_part($param){
        $supplier = isset($param['qty_original']) ? substr($param['qty_original'],31,6) : "";
        $partno = $param['part_number'];

        $get_location = DB::connection("sqlsrv2")
                        ->select("SELECT lokasi from stdpack where suppcode = '{$supplier}' and partnumber= '{$partno}'");
        // $get_location = MasterPart::select("lokasi")->where('suppcode',$supplier)->where('partnumber',$partno);

        // $get_location = DB::table('stdpack')->select('lokasi')->where('suppcode', $supplier)->where('part_number', $partno);
        
        return $get_location[0]->lokasi;   
     
    }

    public function get_type($param){
    $partno = $param['part_number'];
        $get_type = DB::connection("sqlsrv5")
                ->select("SELECT DISTINCT case imincl when '1' then 'DIRECT' else 'INSPECTION' end as sts_insp from sa96t where iprod = '". $partno ."'");
        $get_type =  isset($get_type[0]->sts_insp) ? $get_type[0]->sts_insp : "No Type";
        return $get_type;
        
    }


    public function get_supplierName($param){

        $supplier = isset($param['qty_original']) ? substr($param['qty_original'],31,6) : "";
        $supplierName=DB::connection("sqlsrv2")
                            ->select("SELECT SuppName from Supplier where SuppCode = '{$supplier}'");

        // $supplierName=SupplierMaster::select("SuppName")->where('SuppCode', $supplier);
        // $supplierName = DB::table('Supplier')->select('SuppName')->where('Suppcode', $supplier);


        $supplierName =  $supplierName[0]->SuppName;
        $supplierName = substr($supplierName,0,9);

        return $supplierName;
        
    
                
    }
  
    public function generate  ($label_sorting)
    { 
        $QRcode = QrCode::size(50)           
                ->generate($label_sorting);
        
            return view('sorting.generate',compact('QRcode'));      
    }

    public function scanBalance(Request $request){

        SplitLabel::where('id', $request->id)->update([
            'label_sorting' => $request->input('label_sorting'),
            'label_balance' => $request->input('label_balance')
        ]);
            

            return $request;


    }   

}

