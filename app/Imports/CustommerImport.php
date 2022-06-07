<?php

namespace App\Imports;

use App\Models\Custommer;
use App\Models\Billtest;
use App\Models\Billname;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CustommerImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
//`name`, `birthday`, `address`, `province_id`, `district_id`, `ward_id`, `gender`, `status`, `created_at`, `updated_at`
           $custommerId = Custommer::insertGetId([
               'name' => $row['name'],
               'gender' => $row['gender'],
               'birthday' => $row['birthday'],
               'address' => $row['address'],
               'province_id' => $row['province_id'],
               'district_id' => $row['district_id'],
               'ward_id' => $row['ward_id'],
           ]);
//`id`, `custommer_id`, `row['name']`, `doctor_id`, `diagnose`, `hpv_code`, `thinprep_code`, `sample_code`, `para`, `kinhchot`, `status`, `result_status`,
        $Id_bill=Billtest::insertGetId([
                'custommer_id' =>$custommerId,
                'ousent_id' => $row['ousent_id'],
                'doctor_id' => $row['doctor_id'],
                'diagnose' => $row['diagnose'],
                'thinprep_code' => $row['thinprep_code'],
                'hpv_code' => $row['hpv_code'],
                'sample_code' => $row['sample_code'],
                'para' => $row['para'],
                'kinhchot' => $row['kinhchot'],
            ]);
//billtest_id`, `testname_id`
            Billname::create([
                'billtest_id' =>$Id_bill,
                'testname_id' => $row['testname_id'],
            ]);

      }
   }
 }

