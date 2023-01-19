<?php
include('./phpqrcode/qrlib.php');
// include('./assets/phpqrcode/qrlib.php');

      
        $PARTNO      = $_GET['part_number'];
        $LOCATION    = $_GET['lokasi'];
        $PO          = $_GET['po'];
        $SUPPNAME    = $_GET['supplierName'];
        $STSINSP     = $_GET['type'];
        $INVOICE     =1;

        $newlabel1 = $_GET['label_sorting'];
        $newlabel2 = $_GET['label_balance'];

        $newlabel1_name = str_replace($newlabel1, '/','_');
        $newlabel2_name = str_replace($newlabel2, '/','_');

       
        $qty1 = substr($newlabel1,24,5);
        $qty2 = substr($newlabel2,24,5);

        // echo $newlabel1;
      
        //createQRCodeImages
        $tempDir = './img_qrcode/';
        $qrname1 = substr($newlabel1_name, 30).'.png';
        QRcode::png($newlabel1, $tempDir . $qrname1, QR_ECLEVEL_L, 3);

        $tempDir = './img_qrcode/';
        $qrname2 = substr($newlabel2_name, 30).'.png';
        QRcode::png($newlabel2, $tempDir . $qrname2, QR_ECLEVEL_L, 3);

        // QRcode::png("a");

        $qrcode_label = '';
        $esc = chr(27);
        $data = '';
        $data .= $esc . 'A';
        $data .= $esc . 'H0050' . $esc . 'V0020' . $esc . '2D30,L,03,0,0' . $esc . 'DS2,' . $newlabel1;
        $data .= $esc . 'H0180' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . $PARTNO;
        $data .= $esc . 'H0500' . $esc . 'V0015' . $esc . 'L0202' . $esc . 'S' . 'Loc: ' . $LOCATION;
        $data .= $esc . 'H0180' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'PO: ' . $PO;
        $data .= $esc . 'H0370' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'QTY: ' . $qty1;
        $data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . $SUPPNAME;
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
        $data .= $esc . 'H0530' . $esc . 'V0073' . $esc . 'L0101' . $esc . 'M' . 'Supp: ' . $SUPPNAME;
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
       /*
        if($cekip == '10.230.30.125') {
            $host   = 'newedp5';
            $myfile = fopen("\\\\$host\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
            $txt    = $qrcode_label;
            fwrite($myfile, $txt);
            fclose($myfile);
        } */
        // else if($cekip == '10.230.36.3') {
        //     $host   = 'MC46';
        //     $myfile = fopen("\\\\$host\\PrintSato\\print_".substr($newlabel1_name, 30).".txt","w") or die("Unable to open file! ".error_get_last());
        //     $txt    = $qrcode_label;
        //     fwrite($myfile, $txt);
        //     fclose($myfile);
        // }
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
?>