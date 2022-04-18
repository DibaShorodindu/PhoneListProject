<?php

namespace App\Exports;

use App\Models\Phonelist;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomExport implements FromQuery, WithHeadings
{
    use Exportable;
    protected $ids;
    public function __construct($ids)
    {
        $this->ids = $ids;
    }

    public function query()
    {
        //return DB::table('phone_lists')->whereIn('id',$this->ids)->orderBy('id', 'desc');
        return Phonelist::whereIn('id',$this->ids);
    }
    public function headings() :array
    {
        return [
            'phone',
            'email',
            'uid',
            'first_name',
            'last_name',
            'name',
            'gender',
            'country',
            'location',
            'hometown',
            'relationship_status',
            'education_last_year',
            'work',
        ];
    }
}
