<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Imports\ProvinceImport;
use App\Imports\DistrictImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    // public function importProvince(Request $request)
    // {
    //    // dd($request->file);

    //     Excel::import(new ProvinceImport, $request->file);

    //     return back()->withInput()->with('success','Add  successfully!');
    // }
    public function importDistrict(Request $request)
    {
       //dd($request->file);

        Excel::import(new DistrictImport, $request->file);

        return back()->withInput()->with('success','Add  successfully!');
    }
}