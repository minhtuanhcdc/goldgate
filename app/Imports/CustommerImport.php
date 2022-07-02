<?php

namespace App\Imports;

use App\Models\Custommer;
use App\Models\Billtest;
use App\Models\Billname;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class CustommerImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError
{
use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row)
        {

        $custommerId = Custommer::insertGetId([
               'name' => $row['name'],
               'gender' => 0,
               'birthday' => $row['birthday'],
               'address' => $row['address'],
               'phone' => $row['phone'],
               //'province_id' => $row['province_id'],
               //'district_id' => $row['district_id'],
               //'ward_id' => $row['ward_id'],
           ]);

           $readCode =   substr ( $row['thinprep_code'] ,0, 4 );

        $Id_bill=Billtest::insertGetId([
                'custommer_id' =>$custommerId,
                'ousent_id' => $row['ousent_id'],
                'doctor_id' => $row['doctor_id'],
                'diagnose' => $row['diagnose'],
                'para' => $row['para'],
                'kinhchot' => $row['kinhchot'],
                'sample_code' => $row['sample_code'],
                'thinprep_code' => $row['thinprep_code'],
                'read_code' => $readCode,
                'hpv_code' => $row['hpv_code'],
                //'date_receive' => $row['date_receive'],


            ]);

            Billname::create([
                'billtest_id' =>$Id_bill,
                'testname_id' => $row['testname_id'],
            ]);
      }
   }

    public function rules(): array
    {
        return [
            //'name'=>'required',
            'thinprep_code'=>'unique:billtests,thinprep_code',

        ];
    }

    public function customValidationMessages()
        {
            return [
             // 'name.required' => 'Tên trống',
            'thinprep_code.unique' => 'Trùng mã Thinrep_code',
            ];
        }
}




