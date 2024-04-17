<?php

namespace App\Exports;

use App\Models\Gospochta\Message;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportReport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return  new Collection(Message::all());
    }
}
