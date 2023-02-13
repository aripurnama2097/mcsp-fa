1. scan nik
2. scan qrcode original
3. change qty actual kalo beda dengan qty label scan
4. qty split diambil dari request
5. klik tombol splitlabel
    - compare qrcode original dengan qrcode picking
        - sama -> OK next step
        - beda -> NG ( Label tidak sama dengan label picking ! )
    - send ajax POST dengan parameter
      => sorting_by,rog_number,part_number,label_original,status,qty_split,id, qty actual, reason
        -
