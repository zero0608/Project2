<?php

namespace App\Exports;

use App\Models\Payslips;
use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Payslips::all();
    }
}
