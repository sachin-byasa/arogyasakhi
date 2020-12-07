<?php

namespace App\Exports;

use App\Models\District;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DistrictExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $all_district =District::join('states', 'districts.state_id', '=', 'states.state_id')
        ->select('districts.district_name','states.state_name','districts.entry_date','districts.updated_date')
        ->get();
        return $all_district;
    }

    public function headings(): array
    {
        return [
            'District Name',
            'State Name',
            'Created at',
            'Updated at',

        ];
    }
}

