<?php

namespace App\Imports;

use App\Employeer;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class EmployeerImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employeer([
            'id_member'      => $row['id_job_seeker'],
            'username'       => $row['username'] ? $row['username'] : 'Bitrex'.rand(10,100),
            'first_name'     => $row['first_name'] ? $row['first_name'] : '-',
            'last_name'      => $row['last_name'] ? $row['last_name'] : '-',
            'email'          => $row['email'] ? $row['email'] : '-',
            'password'       => bcrypt('bitrex12345678'),
            'birthdate'      => $row['birth_date'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birth_date']) : now(),
            'npwp_number'    => $row['npwp'] ? $row['npwp'] : '-',
            'is_married'     => 0,
            'gender'         => $row['gender'] == 'Male' ? 1 : 0,
            'status'         => $row['status'] == 'ACTIVE' ? 1 : 0,
            'phone_number'   => $row['phone_number'] ? $row['phone_number'] : '-' ,
            'no_rec'         => $row['no_rec'] ? $row['no_rec'] : '-',
            'position'       => null,
            'parent_id'      => null,
            'sponsor_id'     => null,
            'rank_id'        => null,
            'verification'   => $row['npwp'] ? 1 : 0,
            'created_at'     => $row['join_date'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['join_date']) : now(),
            'updated_at'     => $row['join_date'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['join_date']) : now(),
            'bitrex_cash'    => 0,
            'bitrex_points'  => 0,
            'pv'             => 0,
            'is_update'      => 1,
            'nik'            => $row['id_card_number'] ? $row['id_card_number'] : '-',
            'expired_at'     => $row['expired'] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['expired']) : now() ,
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }
    
    public function chunkSize(): int
    {
        return 100;
    }
}
