<?php

namespace App\Imports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\ToModel;

use App\Models\Custommer;
use App\Models\Billtest;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;


class ResultImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnError
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
          Result::insert([
               'element_id' =>56,
               'hpv_code' => $row['mahpv'],
               'result' =>$row['sco'],
           ]);
          Result::insert([
               'element_id' =>59,
               'hpv_code' => $row['mahpv'],
               'result' =>$row['sco2'],

           ]);
          Result::insert([
               'element_id' =>57,
               'hpv_code' => $row['mahpv'],
               'result' =>$row['sco16'],


           ]);
          Result::insert([
               'element_id' =>58,
               'hpv_code' => $row['mahpv'],
               'result' =>$row['sco18'],


           ]);
      }
   }

    public function rules(): array
    {
        return [
            //'hpv_code'=>'required',
            //'hpv_code'=>'unique:billtests,hpv_code',

        ];
    }

    public function customValidationMessages()
        {
            return [
             // 'name.required' => 'Tên trống',
            //'hpv_code.required' => 'Ma HPV trong',
            ];
        }
}
