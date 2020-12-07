<?php

namespace App\Exports;

use App\Models\State;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StateExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $all_states =State::select('state_name','entry_date','updated_date')->get();
        return $all_states;
    }

    public function headings(): array
    {
        return [
            'State Name',
            'Created at',
            'Updated at',

        ];
    }
}

