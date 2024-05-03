<?php

namespace App\Exports;

use App\Models\Fssp\Reestr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReestrExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  Reestr::jsonDecodeReestrsLine();
    }
}
