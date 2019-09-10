<?php

namespace App\Imports;

use App\Employeer;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employeer([
            //
        ]);
    }
}
