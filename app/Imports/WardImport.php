<?php

namespace App\Imports;

use App\Models\Ward;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class WardImport implements ToCollection,WithHeadingRow,WithLimit,SkipsOnError,WithValidation
{
    use Importable, SkipsErrors;
    /**
     * id`, `code`, `name`, `district_id`, `status`,
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     return new Ward([
    //         'code'     => $row['code'],
    //         'name'     => $row['name'],
    //         'district_id'     => $row['district_id'],
    //         'status'     => 1,
    //     ]);
    // }

    public function collection(Collection $rows)
    {
        // Validator::make($rows->toArray(), $this->rules())->validate();


        /* maybe I need to do something like this: */
        // if ($validator->fails()) {
        //     return redirect()->route('custommers.index')->with('failure', $validator);

        // }
        // Validator::make($rows->toArray(), [
        //    // '*.0' => 'required',
        //     'thinprep_code' => 'unique:billtests,thinprep_code',
        // ])->validate();
        foreach ($rows as $row){
            $data = [
                'code'     => $row['code'],
                'name'     => $row['name'],
                'district_id'     => $row['district_id'],
                'status'     => 1,
            ];

            Ward::create($data);
        }
   }

   public function rules(): array
   {
       return [
        'code'=>'required|unique:wards,code',
        'name'=>'required',
        'district_id'=>'required',


       ];
   }


    public function limit(): int
    {
        return 10; // only take 100 rows
    }
}
