<?php

namespace App\Http\Controllers;

use App\Models\MasterEmployee;
use Illuminate\Http\Request;
use App\Models\Sorting;
use App\Models\RegisterPart;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SortingController extends Controller
{
    public function index()
    {      
        // $data2 = RegisterPart::where('id')->get();  
        $pagination =5; 
        $data = Sorting::latest()->paginate(5);
        return view ('sorting.index',compact('data'))->with('i', (request()->input('page', 1) -1) * $pagination);   
    }

    public function view($id){
        $data = Sorting::where('id', $id)->get();

        QrCode::generate('Make me into a QrCode!');
        
        return view ('sorting.view',
        compact('data'));
    }


    public function splitLabel(Request $request){

        $rog_number     =   $request->rog_number;     
        $part_number    =   substr("E31-1110-22A     1234567 40    I10827 A2B-0002-00    202211161618210132000030",0,11);
        $po             =   substr("E31-1110-22A     1234567 40    I10827 A2B-0002-00    202211161618210132000030",16,7);
      
        $splitLabel     =   $request->label_original;
        $raw_nik        =   $request->sorting_by; //2241312F
        $splitqty       =   $request->qty_split;
        

        // $raw_nik    = isset($_REQUEST['sorting_by']) ? $_REQUEST['sorting_by'] : "";
        // $splitLabel = isset($_REQUEST['label_original']) ? $_REQUEST['label_original'] : "";
        // $splitqty   = isset($_REQUEST['qty_split']) ? $_REQUEST['qty_split'] : "";

        // INSERT INTO splitLabel
         DB::table('record_sorting')->insert([        
            'sorting_by'    => $raw_nik,
            'rog_number'    => $rog_number,
            'part_number'   => $part_number, 
            'PO'            => $po,
            'label_original'=> $splitLabel,
            'qty_split'     => $splitqty        
        ]);   

       if (strlen($splitqty) > 0){
            $len = strlen($raw_nik);
            if($len == 5){
                $nik = $raw_nik;
            }
            else{
                $nik = substr($raw_nik, 2,5);
            }
            
            $maxqty         = substr($splitLabel, 24,5);// QTY LABEL ORIGINAL
            $splitqty2      = intval($maxqty) - intval($splitqty); //FOR LABEL BALANCE
            $startlabel     = substr($splitLabel, 0,24);//E31-1110-22A 1234567
            $middlelabel    = substr($splitLabel, 30,22);//I10827 A2B-0002-00
            $date_temp1     = date("YmdHis");
            $microdate_temp1= microtime();
            $microdate_temp2= explode(" ",$microdate_temp1);
            $microdate      = substr($microdate_temp2[0], 2, -4);
            $date           = $date_temp1 . $microdate;
            $sequence1      = str_pad(1,6,"0", STR_PAD_LEFT);
            $sequence2      = str_pad(2,6,"0", STR_PAD_LEFT);
            $qty1           = str_pad($splitqty,5," ",STR_PAD_RIGHT);//QTY LABEL SORTING
            $qty2           = str_pad($splitqty2,5," ",STR_PAD_RIGHT); //QTY LABEL BALANCE
            $newlabel1      = $startlabel . $qty1 . ' ' . $middlelabel . $date . $sequence1;//LABEL  SORTING
            $newlabel2      = $startlabel . $qty2 . ' ' . $middlelabel . $date . $sequence2;//LABEL  BALANCE
        
            $newlabel1_name = str_replace($newlabel1, '/','_');//LABEL  SORTING
            $newlabel2_name = str_replace($newlabel2, '/','_');//LABEL  BALANCE
         
           return $newlabel2;
                // try{
                //    $query  = " SELECT  ID, sorting_by,rog_number,part_number, PO, label_original
                //                 FROM    [Record_sorting] 
                //                 where   label_original = '{$splitLabel}'";
                //    $query = DB::table('record_sorting')
                //    ->select('ID','sorting_by','rog_number','part_number', 'PO', 'label_original')
                //    ->where('label_original','=', $splitLabel)->get();

                //    return $query;
        
                    // $ID         = $rs->fields['0'];
                    // $PARTLABEL  = $rs->fields['1'];
                    // $PARTNO     = $rs->fields['2'];
                    // $LOCATION   = $rs->fields['3'];
                    // $PO         = $rs->fields['4'];
                    // $SUPPNAME   = $rs->fields['5'];
                    // $INVOICE    = $rs->fields['6'];
                    // $STSINSP    = $rs->fields['7'];


                    // $ID             = $rs->fields['0'];
                    // $raw_nik        = $rs->fields['1'];
                    // $rog_number     = $rs->fields['2'];
                    // $part_number    = $rs->fields['3'];
                    // $PO             = $rs->fields['4'];
                    // $splitLabel     = $rs->fields['5'];
        
                    //createQRCodeImages LABEL  SORTING
                    // $tempDir = '../../img_qrcode/';
                    // $qrname1 = substr($newlabel1_name, 30).'.png';
                    //  QRcode::png($newlabel1, $tempDir . $qrname1, QR_ECLEVEL_L, 3);
                    
                    // //createQRCodeLabel2 LABEL  BALANCE
                    // $tempDir = '../../img_qrcode/';
                    // $qrname2 = substr($newlabel2_name, 30).'.png';
                    // QRcode::png($newlabel2, $tempDir . $qrname2, QR_ECLEVEL_L, 3);
        
                    // $qrcode_label = '';
                    // $esc = chr(27);
                    // $data = '';
                    // $data .= $esc . 'A';
                    // $data .= $esc . 'H0050' . $esc . 'V0020' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . $newlabel1;
                    // $data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'part_number';
                    // $data .= $esc . 'H0500' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $LOCATION;
                    // $data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $PO;
                    // $data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $qty1;
                    // $data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . substr($SUPPNAME,0,9);
                    // $data .= $esc . 'H0180' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Invc: ' . $INVOICE;
                    // $data .= $esc . 'H0530' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Type: ' . $STSINSP;
                    // $data .= $esc . 'Q1';
                    // $data .= $esc . 'Z';

                    // $data .= $esc . 'A';
                    // $data .= $esc . 'H0050' . $esc . 'V0020' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . $newlabel2;
                    // $data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . $PARTNO;
                    // $data .= $esc . 'H0500' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $LOCATION;
                    // $data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $PO;
                    // $data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $qty2;
                    // $data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . substr($SUPPNAME,0,9);
                    // $data .= $esc . 'H0180' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Invc: ' . $INVOICE;
                    // $data .= $esc . 'H0530' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Type: ' . $STSINSP;
                    // $data .= $esc . 'Q1';
                    // $data .= $esc . 'Z';
                    // $qrcode_label.= $data;
        
                    // $cekip  = getenv("REMOTE_ADDR");
                    // $host   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                    // if($host === 'EDP11.JVC-JEIN.CO.ID') {
                    //     $myfile = fopen("\\\\136.198.117.173\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
                    //     $txt    = $qrcode_label;
                    //     fwrite($myfile, $txt);
                    //     fclose($myfile);
                    // }
                    // else if ( $cekip == '10.230.36.156' || $cekip == '10.230.37.25' ){
                    //     $myfile = fopen("\\\\$cekip\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
                    //     $txt    = $qrcode_label;
                    //     fwrite($myfile, $txt);
                    //     fclose($myfile);
                    // } 
                    // else {
                    //     $myfile = fopen("\\\\$cekip\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
                    //     $txt    = $qrcode_label;
                    //     fwrite($myfile, $txt);
                    //     fclose($myfile);
                    // }
        
                    // try{
                    //     $query3 = "EXEC mc_splitlabel '{$nik}','{$empname}','{$ID}','{$newlabel1}','{$newlabel2}','{$qty1}','{$qty2}'";
                    //     $rs3    = $conn->Execute($query3);
                    //     $rs3->Close();
        
                    //     echo "{ 'success': true,
                    //         'msg': '<h2 style=\"text-align: center; color: green;\">label exists</h2>'}"; 
        
                    // }
                    // catch(\Exception $e) {
                    //     echo $e->getMessage();
                       
                    // }
                // }
                // catch(Handler $e) {
                //     $var_msg    = $conn->ErrorNo();
                //     $error      = $conn->ErrorMsg();
                //     $error_msg  = str_replace(chr(50), "", $error);
                //     echo "{'success':false,'msg':$error_msg}";
                // }
            // }

            // catch(Handler $e) {
            //     $var_msg    = $conn->ErrorNo();
            //     $error      = $conn->ErrorMsg();
            //     $error_msg  = str_replace(chr(50), "", $error);
            //     echo "{'success':false,'msg':$error_msg}";
            // }
        } 
       
    }
}


