<?php

namespace App\Exports;

use App\Models\Block;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BlockExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $allBlocks = Block::join('districts', 'blocks.district_id', 'districts.district_id')
        ->join('states', 'districts.state_id', 'states.state_id')
        ->select('blocks.block_name','districts.district_name','states.state_name','blocks.entry_date','blocks.updated_date')
        ->get();

        return $allBlocks;
    }

    public function headings(): array
    {
        return [
            'Block Name',
            'District Name',
            'State Name',
            'Created at',
            'Updated at',

        ];
    }
}

