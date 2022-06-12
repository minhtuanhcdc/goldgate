<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Ousent;
use App\Models\Doctor;
use App\Models\Custommer;
use App\Models\Billtest;
use App\Models\Billname;
use App\Models\Testname;
use App\Models\Testelement;
use App\Models\Custommeraddress;
use App\Http\Requests\SaveCustommerRequest;
use App\Http\Resources\TestnameResource;
use DB;

class PrintController extends Controller
{
    public function printOne(Request $request){
        //dd($request->id);
        $billtests=Billtest::where('id',$request->id)->get();
        return $billtests;
    }

    public function showPrint(Request $request){
       // $perpage = $request->perpageFill?$request->perpageFill:5;
        //$ousentFill=$request->ousentFill?$request->ousentFill:'all';



        $billtests=Billtest::whereIn('id',$request->billId)->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->get();

        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        $provinces = Province::with('districts','wards')->get();
        $districts = District::get();
        $wards = Ward::get();
        $ousents = Ousent::select('id','name')->get();
        $doctors = Doctor::select('id','name','ousent_id')->get();

        $filters=[
            'ousentFill'=>$request->ousentFill,
        ];
       // dd($billtests);
        return Inertia::render('Prinview/Index',[
            'billtests'=>$billtests,
            'nametests'=>TestnameResource::collection(Testname::select('id','name')->get()),
            'testElements'=>$testElements,
            'provinces'=>$provinces,
            'districts'=>$districts,
            'wards'=>$wards,
            'ousents'=>$ousents,
            'doctors'=>$doctors,
            'filters'=>$filters,
            'custommer'=>Custommer::with('province')->get(),
        ]);
    }
}
