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

    

   

    public function generate  ($splitlabel)
    {
      
        // $datas = DB::table('split_Label')->get();
        $qrCode = QrCode::size(100)           
                ->generate($splitlabel);

        // return view('sorting.print',  compact('datas'));

        // $qrCode1 ="tes";
        // $qrCode = QrCode::size(200)->generate("a");
        // $value = $splitlabel; 
    
        // $data2= DB::table('print_label')->insert([
        //     'splitLabel'=> $value
        //     ]);
        
            return view('sorting.generate',compact('qrCode'));      
    }



    public function splitLabelnew(Request $request){
        // 1. data request diinput ke database
        // -----------------------------------
        $rog_number     =   $request->rog_number;     
        $part_number    =   substr("E31-1110-22A     1234567 40    I10827 A2B-0002-00    202211161618210132000030",0,11);
        $po             =   substr("E31-1110-22A     1234567 40    I10827 A2B-0002-00    202211161618210132000030",16,7);
      
        $splitlabel     =   $request->label_original;
        $raw_nik        =   $request->sorting_by; //2241312F
        $splitqty       =   $request->qty_split;
        
        // INSERT INTO splitlabel
        DB::table('record_sorting')->insert([        
            'sorting_by'    => $raw_nik,
            'rog_number'    => $rog_number,
            'part_number'   => $part_number, 
            'PO'            => $po,
            'label_original'=> $splitlabel,
            'qty_split'     => $splitqty        
        ]);  


        // 2. pecah qty
        // -----------------------------------
        // buat barcode
        // print barcode


    }


    public function scanBalance(Request $request){

        SplitLabel::where('id', $request->id)->update([
            'label_sorting' => $request->input('label_sorting'),
            'label_balance' => $request->input('label_balance')
        ]);
            

            return $request;


    }   
        
       




    

}

