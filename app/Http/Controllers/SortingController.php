<?php

namespace App\Http\Controllers;

use App\Models\MasterEmployee;
use Illuminate\Http\Request;
use App\Models\PartSorting;
use App\Models\SplitLabel;
use App\Models\RegisterPart;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\RecordSorting;


class SortingController extends Controller
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

    public function splitLabel(Request $request ){

            $rog_number     =   $request->rog_number;                  
            $PARTNO         = $request->part_number;
            $part_number    =   substr($PARTNO,0,11);
            $PO_NUMBER      = $request->po;
            $po             =   substr($PO_NUMBER,16,7);
        
        
            $raw_nik        =   $request->sorting_by; //2241312F
            $splitlabel     =   $request->label_original;
            $splitqty       =   $request->qty_split;

            // LABEL ORIGINAL SAMPLE = A2B-0002-00     1234567 30    I10827 A2B-0002-00    202211161618210132000002

            $maxqty         = substr($splitlabel, 24,5); //QTY DI LABEL ORIGINAL
            $splitqty2      = intval($maxqty) - intval($splitqty); //LABEL BALANCE = (ORIGINAL - QTY SPLIT)
            $startlabel     = substr($splitlabel, 0,24);//A2B-0002-00 1234567
            $middlelabel    = substr($splitlabel, 30,22);// I10827 A2B-0002-00
            $date_temp1     = date("YmdHis");
            $microdate_temp1= microtime();
            $microdate_temp2= explode(" ",$microdate_temp1);
            $microdate      = substr($microdate_temp2[0], 2, -4);
            $date           = $date_temp1 . $microdate;
            $sequence1      = str_pad(1,6,"0", STR_PAD_LEFT);
            $sequence2      = str_pad(2,6,"0", STR_PAD_LEFT);
            $qty1           = str_pad($splitqty,5," ",STR_PAD_RIGHT);//QTY LABEL SORTING
            $qty2           = str_pad($splitqty2,5," ",STR_PAD_RIGHT);//QTY LABEL BALANCE
            $newlabel1      = $startlabel . $qty1 . ' ' . $middlelabel . $date . $sequence1;
            $newlabel2      = $startlabel . $qty2 . ' ' . $middlelabel . $date . $sequence2;
        
            $newlabel1_name = str_replace($newlabel1, '/','_');//LABEL SORTING
            $newlabel2_name = str_replace($newlabel2, '/','_');//LABEL BALANCE


        //   return $newlabel1;
          


          $update_status ='SORTING';
          PartSorting::where("status",$request->status)
          ->where("part_number",$request->part_number)
          ->where("rog_number",$request->rog_number)
          ->update(["status" => $update_status]);
  
          // INSERT INTO splitlabel
          DB::table('split_Label')->insert([        
              'sorting_by'    => $raw_nik,
              'rog_number'    => $rog_number,
              'part_number'   => $part_number, 
              'PO'            => $po,
              'label_original'=> $splitlabel,
              'status'        => $update_status,
              'qty_split'     => $splitqty        
          ]);   
  
            // $dataSplit =[
            //     "maxqty"         => $maxqty ,// QTY LABEL ORIGINAL
            //     "splitqty2"      => $splitqty2,
            //     "startlabel"     => $startlabel,
            //     "middlelabel"    => $middlelabel,
            //     "date_temp1"     => $date,
            //     "microdate_temp1"=> $microdate_temp1,
            //     "microdate_temp2"=> $microdate_temp2,
            //     "microdate"      => $microdate,
            //     "date"           => $date,
            //     "sequence1"      => $sequence1,
            //     "sequence2"      => $sequence2,
            //     "qty1"           => $qty1,
            //     "qty2"           => $qty2,
            //     "newlabel1"      => $newlabel1,
            //     "newlabel2"      => $newlabel2,
            //     "newlabel1_name" => $newlabel1_name,
            //     "newlabel2_name" => $newlabel2_name,

            // ];     
            
        
            // $request->session()->put('newlabel1_name');

            //EXTEND DATA TO GENERATE METHOD
            $this->generate($splitlabel);

            // return view('sorting.print', compact(
            //     'dataSplit'
            // )); 
            

            return response()->json(['redirect' => '{id}/generate']);


    }

    public function splitLabelnew(Request $request){
        // return $request;
        
        // id=>"5"
        // label_original=>"A2B-0002-00     1234567 30    I10827 A2B-0002-00    202211161618210132000002"
        // part_number=>"A2B-0002-00"
        // qty_split=>"8"
        // rog_number=>"ROG1401"
        // sorting_by=>"37299"
        // status=>"PICKING"

        $nik = $request->sorting_by;
        $raw_nik = substr($nik, 2,5);

        $rog_number = $request->rog_number;
        $part_number = $request->part_number;
        $label_original = $request->label_original;
        $qty_split = $request->qty_split;
        $status = $request->status;
        $po = isset($label_original) ? substr($label_original,16,7) : 0;
        $update_status ='SORTING';


        $maxqty         = substr($label_original, 24,5); //QTY DI LABEL ORIGINAL
        $splitqty2      = intval($maxqty) - intval( $qty_split); //LABEL BALANCE = (ORIGINAL - QTY SPLIT)
        $startlabel     = substr($label_original, 0,24);//A2B-0002-00 1234567
        $middlelabel    = substr($label_original, 30,22);// I10827 A2B-0002-00
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
            'label_balance' => $label_balance
                    
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
            "label_balance" => $label_balance
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
        $supplier = isset($param['label_original']) ? substr($param['label_original'],31,6) : "";
        $partno = $param['part_number'];

        $get_location = DB::connection("sqlsrv5")
                ->select("SELECT lokasi from stdpack where suppcode = '{$supplier}' and partnumber= '{$partno}'");
        return $get_location[0]->lokasi;   
     
    }

    public function get_type($param){
        $partno = $param['part_number'];
        $get_type = DB::connection("sqlsrv5")
                ->select("SELECT DISTINCT case imincl when '1' then 'DIRECT' else 'INSPECTION' end as sts_insp from sa96t where iprod = '". $partno ."'");
        return $get_type[0]->sts_insp;
        
    }


    public function get_supplierName($param){

        $supplier = isset($param['label_original']) ? substr($param['label_original'],31,6) : "";
        $supplierName=DB::connection("sqlsrv5")
                ->select("SELECT SuppName from Supplier where SuppCode = '{$supplier}'");
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

