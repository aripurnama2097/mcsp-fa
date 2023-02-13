MODUL BUG/DOING :


1. REGISTER PART: OK
    <!-- 1. bug (success , register part modul) -->
    <!-- 2. subs nik -->

  
2. PICKING PART: OK
    <!-- 1. substring P/N -->

    <!-- 2. inputan nik dihidden -->
    <!-- 3. result hasil compare -->
    <!-- 4. OK/NG status
     -->
3. SORTING PART: OK

    <!-- 1. Input di form Qty berdasrkan Qty request -->
    <!-- 2. OK/NG -->
    <!-- 3. Lokasi Supplier -->
    
4. BALANCE : OK
    <!-- 1. update to table split_label -->
5. RECORD SORTING: 
    <!-- 1. Export CSV -->
    <!-- 2. Filter base on date-->
   
    
    
6. Template : OK
    <!-- 1. Mean menu mobile -->


TESTING 24/01
<!-- 1. Auto P/N
2. Bug Confirm Part
<!-- 3. Add NIK Confirm -->
<!-- 4. disabled qty
5. Edit qty saat split ( Qty original tidak sesuai ada tomjery) --> 

TESTING 26/01
<!-- 1. Auto link P/N from picking  -->
2. Qty Label original < Qty Request
    > Scan label original
    > Notif Scan Kurang
    > scan ulang sampai qty OK
<!-- 3. Update status di Menu ROG ( Berdasarkan status waiting sorting) -->
<!-- 4. Reset Password -->
5. Filter Pagination



# sorting part
1. public/sorting untuk pilih part yang disorting (OK)
2. public/sorting/view/{id} proses scanlabel ori dan qty split (OK)
3. proses sorting 
    - update partsorting 
    - insert split_Label
    - print out qrcode
        yg dibutuhkan : a. PARTNO
                        b. Location
                        <!-- $sql = "select lokasi from stdpack where suppcode = '{$supplier}' and partnumber= '{$partno}'";
                                    $nt = $edi->Execute($sql);
                                    $location = $nt->fields[0];
                                    $rs4->Close(); -->
                        c. PO
                        d. QTY
                        e. Supp 
                        <!-- $qsupp = "SELECT SuppName from Supplier where SuppCode = '{$supplier}'";
                        $get_suppname = $dbs_con->Execute($qsupp);
                        $suppname = trim($get_suppname->fields['0']);
                        $get_suppname->Close(); -->
                        f. Invc
                        g. Type
                        <!-- $qtype = "select case imincl when '1' then 'DIRECT' else 'INSPECTION' end as sts_insp from sa96t where iprod = '". $partno ."'";
                                    $rs4 = $db_qrinvoice->Execute($qtype);
                                    $sts_inspection = $rs4->fields[0];
                                    $rs4->Close(); -->

