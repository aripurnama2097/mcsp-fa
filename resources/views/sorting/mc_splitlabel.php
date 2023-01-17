<?php
// session_start();
include('../asset/phpqrcode/qrlib.php');
include '../connection.php';
date_default_timezone_set("Asia/jakarta");

$raw_nik    = isset($_REQUEST['splitnik']) ? $_REQUEST['splitnik'] : "";
$splitlabel = isset($_REQUEST['splitlabel']) ? $_REQUEST['splitlabel'] : "";
$splitqty   = isset($_REQUEST['splitqty']) ? $_REQUEST['splitqty'] : "";

if (strlen($splitqty) > 0){
    $len = strlen($raw_nik);
    if($len == 5){
        $nik = $raw_nik;
    }
    else{
        $nik = substr($raw_nik, 2,5);
    }
    $maxqty         = substr($splitlabel, 24,5);
    $splitqty2      = intval($maxqty) - intval($splitqty);
    $startlabel     = substr($splitlabel, 0,24);
    $middlelabel    = substr($splitlabel, 30,22);
    $date_temp1     = date("YmdHis");
    $microdate_temp1= microtime();
    $microdate_temp2= explode(" ",$microdate_temp1);
    $microdate      = substr($microdate_temp2[0], 2, -4);
    $date           = $date_temp1 . $microdate;
    $sequence1      = str_pad(1,6,"0", STR_PAD_LEFT);
    $sequence2      = str_pad(2,6,"0", STR_PAD_LEFT);
    $qty1           = str_pad($splitqty,5," ",STR_PAD_RIGHT);
    $qty2           = str_pad($splitqty2,5," ",STR_PAD_RIGHT);
    $newlabel1      = $startlabel . $qty1 . ' ' . $middlelabel . $date . $sequence1;
    $newlabel2      = $startlabel . $qty2 . ' ' . $middlelabel . $date . $sequence2;

    $newlabel1_name = str_replace($newlabel1, '/','_');
    $newlabel2_name = str_replace($newlabel2, '/','_');

    try{
        $query  =  "SELECT  [EMP_NAME]
                    FROM    [payroll].[sapayroll].[HCE_access]
                    where   lastday is null
                    and     emp_no = '{$nik}'";
        $rs     = $db_payroll->Execute($query);
        $empname= trim($rs->fields['0']);
        $rs->Close();

        try{
            $query  = " SELECT  ID, PARTLABEL, PARTNO, LOCATION, PO, SUPPNAME, INVOICE, STSINSP 
                        FROM    [MC_expParts] 
                        where   PARTLABEL = '{$splitlabel}'";
            $rs     = $conn->Execute($query);

            $ID         = $rs->fields['0'];
            $PARTLABEL  = $rs->fields['1'];
            $PARTNO     = $rs->fields['2'];
            $LOCATION   = $rs->fields['3'];
            $PO         = $rs->fields['4'];
            $SUPPNAME   = $rs->fields['5'];
            $INVOICE    = $rs->fields['6'];
            $STSINSP    = $rs->fields['7'];

            //createQRCodeImages
            $tempDir = '../img_qrcode/';
            $qrname1 = substr($newlabel1_name, 30).'.png';
            QRcode::png($newlabel1, $tempDir . $qrname1, QR_ECLEVEL_L, 3);

            $tempDir = '../img_qrcode/';
            $qrname2 = substr($newlabel2_name, 30).'.png';
            QRcode::png($newlabel2, $tempDir . $qrname2, QR_ECLEVEL_L, 3);

            $qrcode_label = '';
            $esc = chr(27);
            $data = '';
            $data .= $esc . 'A';
            $data .= $esc . 'H0050' . $esc . 'V0020' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . $newlabel1;
            $data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . $PARTNO;
            $data .= $esc . 'H0500' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $LOCATION;
            $data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $PO;
            $data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $qty1;
            $data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . substr($SUPPNAME,0,9);
            $data .= $esc . 'H0180' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Invc: ' . $INVOICE;
            $data .= $esc . 'H0530' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Type: ' . $STSINSP;
            $data .= $esc . 'Q1';
            $data .= $esc . 'Z';
            $data .= $esc . 'A';
            $data .= $esc . 'H0050' . $esc . 'V0020' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . $newlabel2;
            $data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . $PARTNO;
            $data .= $esc . 'H0500' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $LOCATION;
            $data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $PO;
            $data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $qty2;
            $data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . substr($SUPPNAME,0,9);
            $data .= $esc . 'H0180' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Invc: ' . $INVOICE;
            $data .= $esc . 'H0530' . $esc . 'V0108' . $esc . 'L0101' . $esc . 'M' . 'Type: ' . $STSINSP;
            $data .= $esc . 'Q1';
            $data .= $esc . 'Z';
            $qrcode_label.= $data;

            $cekip  = getenv("REMOTE_ADDR");
            $host   = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            if($host === 'EDP11.JVC-JEIN.CO.ID') {
                $myfile = fopen("\\\\136.198.117.173\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
                $txt    = $qrcode_label;
                fwrite($myfile, $txt);
                fclose($myfile);
            }
         
            else if ( $cekip == '10.230.36.156' || $cekip == '10.230.37.25' ){
                $myfile = fopen("\\\\$cekip\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
                $txt    = $qrcode_label;
                fwrite($myfile, $txt);
                fclose($myfile);
            } 
            else {
                // $myfile = fopen("\\\\$host\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
                $myfile = fopen("\\\\$cekip\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
                $txt    = $qrcode_label;
                fwrite($myfile, $txt);
                fclose($myfile);
            }

            try{
                $query3 = "EXEC mc_splitlabel '{$nik}','{$empname}','{$ID}','{$newlabel1}','{$newlabel2}','{$qty1}','{$qty2}'";
                $rs3    = $conn->Execute($query3);
                $rs3->Close();

                echo "{ 'success': true,
                    'msg': '<h2 style=\"text-align: center; color: green;\">label exists</h2>'}"; 

            }
            catch(exception $e) {
                $var_msg    = $conn->ErrorNo();
                $error      = $conn->ErrorMsg();
                $error_msg  = str_replace(chr(50), "", $error);
                echo "{'success':false,'msg':$error_msg}";
            }
        }
        catch(exception $e) {
            $var_msg    = $conn->ErrorNo();
            $error      = $conn->ErrorMsg();
            $error_msg  = str_replace(chr(50), "", $error);
            echo "{'success':false,'msg':$error_msg}";
        }
    }
    catch(exception $e) {
        $var_msg    = $conn->ErrorNo();
        $error      = $conn->ErrorMsg();
        $error_msg  = str_replace(chr(50), "", $error);
        echo "{'success':false,'msg':$error_msg}";
    }
}
else if (strlen($splitlabel) > 0){

    try{
        $query      =  "SELECT  count(*)
                        FROM    [CRITICALPART].[dbo].[MC_scanIssue]
                        where   [partLabel] = '{$splitlabel}'";
        $rs         = $conn->Execute($query);
        $chkscan    = trim($rs->fields['0']);
        $rs->Close();

        if($chkscan == 0){
            try{
                $query      =  "SELECT  count(*)
                                FROM    [CRITICALPART].[dbo].[MC_expParts]
                                where   [partLabel] = '{$splitlabel}'";
                $rs         = $conn->Execute($query);
                $chkdata    = trim($rs->fields['0']);
                $rs->Close();
    
                if($chkdata == 0){
                    echo json_encode([
                        "success"   => false
                        ,"msg"      => '<h3 style=\"color:#b71c1c;text-align:center\">LABEL NOT FOUND !<br> PLEASE SCANNING REGISTERED LABEL</h3>'
                    ]);
                }
                else{
                    echo json_encode([
                        "success"   => true
                        ,"msg"      => '<h2 style=\"text-align: center; color: green;\">label exists</h2>'
                    ]);
                }
            }
            catch(exception $e) {
                $var_msg    = $conn->ErrorNo();
                $error      = $conn->ErrorMsg();
                $error_msg  = str_replace(chr(50), "", $error);
                echo "{'success':false,'msg':$error_msg}";
            }
        }
        else{
            echo json_encode([
                "success"   => false
                ,"msg"      => '<h2 style="text-align: center; color: green;">PART LABEL ALREADY ISSUE !</h2>'
            ]);
        }
    }
    catch(exception $e) {
        $var_msg    = $conn->ErrorNo();
        $error      = $conn->ErrorMsg();
        $error_msg  = str_replace(chr(50), "", $error);
        
        echo json_encode([
            "success"   => false
            ,"msg"      => $error_msg
        ]);
    }
}
else if (strlen($raw_nik) > 0){
    $len = strlen($raw_nik);
    if($len == 5){
        $nik = $raw_nik;
    }
    else{
        $nik = substr($raw_nik, 2,5);
    }
    try{
        $query  =  "SELECT  [EMP_NAME]
                    FROM    [payroll].[sapayroll].[HCE_access]
                    where   lastday is null
                    and     emp_no = '{$nik}'";
        $rs     = $db_payroll->Execute($query);
        $empname= trim($rs->fields['0']);
        $rs->Close();

        if($empname == '' || empty($empname)|| $empname == null){
           
            echo json_encode([
                "success"   => false
                ,"msg"      => '<h3 style=\"color:#b71c1c;text-align:center\">NIK NOT FOUND !<br> PLEASE SCANNING CARDNETIC</h3>'
            ]);
        }
        else{

            echo json_encode([
                "success"   => true
                ,"msg"      => '<h2 style=\"text-align: center; color: green;\">NIK EXISTS</h2>'
            ]);
        }
    }
    catch(exception $e) {
        $var_msg    = $conn->ErrorNo();
        $error      = $conn->ErrorMsg();
        $error_msg  = str_replace(chr(50), "", $error);
        
        echo json_encode([
            "success"   => false
            ,"msg"      => $error_msg
        ]);
    }
}

$conn->Close();
$conn = NULL;
?>
