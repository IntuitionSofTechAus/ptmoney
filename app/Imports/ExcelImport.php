<?php

namespace App\Imports;

use App\Models\District;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new District([
            'name'=>$row[0],
            'proviance'=>$row[1],
            'postcode'=>$row[2],
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

    }
}
