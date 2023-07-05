<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\CRUD\_Muontra;

class MuonTraExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $mt = new _Muontra();
        // dd($mt->exportOutOfDate());
        return $mt->exportOutOfDate();
    }
}
