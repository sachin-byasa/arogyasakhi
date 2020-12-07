<?php

namespace App\Exports;

use App\Models\Village;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VillageExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $all_villages  = Village::join('blocks', 'villages.block_id', 'blocks.block_id')
        ->join('districts', 'blocks.district_id', 'districts.district_id')
        ->join('states', 'districts.state_id', 'states.state_id')
        ->select('villages.village_name','blocks.block_name','districts.district_name','states.state_name','villages.entry_date','villages.updated_date')
        ->get();
        return $all_villages;
    }

    public function headings(): array
    {
        return [
            'Village Name',
            'Block Name',
            'District Name',
            'State Name',
            'Created at',
            'Updated at',

        ];
    }
}

