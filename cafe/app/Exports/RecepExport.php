<?php

namespace App\Exports;

use App\Models\Receipts;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecepExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Receipts::all();
    }
}
