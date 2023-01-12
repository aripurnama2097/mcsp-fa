<?php

namespace App\Exports;

use App\Models\RecordSorting;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RecordExport implements  WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // protected $data;
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }


    public function headings(): array
    {
        return ["NO","NIK","ROG NUMBER","PART NUMBER","PO", "LABEL ORIGINAL","STATUS","DATE","LABEL SORTING","LABEL BALANCE"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    
}
