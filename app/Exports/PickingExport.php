<?php

namespace App\Exports;

use App\Models\Picking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PickingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Picking::all();
    }


    public function headings(): array
    {
        return ["rog_number", "part_number","scan_label"];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    
}
