<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Ousent;
use App\Models\Ouread;
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
    public function printThinprep(Request $request){
        $perpage = $request->perPage?$request->perPage:20;
        $ousentFill=$request->ousentFill?$request->ousentFill:'all';
        $readcodeFill=$request->readcodeFill?$request->readcodeFill:'all';
        $startDate=$request->startDate?$request->startDate:'';
        $endDate=$request->endDate?$request->endDate:'';

        if($request->ousentFill && $request->ousentFill !=='all'){
           // dd($request->ousentFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->where('thinprep_code','!=',null)->where('ousent_id',$ousentFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }

        if($request->readcodeFill && $request->readcodeFill !=='all'){
            //dd($request->readcodeFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->where('thinprep_code','!=',null)->where('read_code',$readcodeFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }
        if($startDate && $endDate && $ousentFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])
            ->where('thinprep_code','!=',null)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('read_code',$readcodeFill)
            ->paginate($perpage)->withQueryString();
        }
        else{
           // dd($request->perpage);
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])
        ->where('thinprep_code','!=',null)
        ->paginate($perpage)->withQueryString();
        }
        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        //dd($billtests);
        $provinces = Province::with('districts','wards')->get();
        $districts = District::get();
        $wards = Ward::get();

        $ousents = Ousent::select('id','name','logo')->get();
        $doctors = Doctor::with('ousent')->get();
        $readcodes = Ouread::get();
        // $nametests = Testname::select('id','name')->get();
        $nametests=TestnameResource::collection(Testname::get());
        $filters=[
            'ousentFill'=>$request->ousentFill,
        ];
        return Inertia::render('PrintResult/IndexThin',[
            'billtests'=>$billtests,
            'nametests'=> $nametests,
            'testElements'=>$testElements,
            'provinces'=>$provinces,
            'districts'=>$districts,
            'wards'=>$wards,
            'ousents'=>$ousents,
            'doctors'=>$doctors,
            'readcodes'=>$readcodes,
            'filters'=>$filters,
            'custommer'=>Custommer::with('province')->get(),
        ]);
    }
    public function printHpv(Request $request){
        $perpage = $request->perPage?$request->perPage:5;
        $ousentFill=$request->ousentFill?$request->ousentFill:'all';
        $readcodeFill=$request->readcodeFill?$request->readcodeFill:'all';
        $startDate=$request->startDate?$request->startDate:'';
        $endDate=$request->endDate?$request->endDate:'';

        if($request->ousentFill && $request->ousentFill !=='all'){
           // dd($request->ousentFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','resulthpvs'])->where('hpv_code','!=',null)->where('ousent_id',$ousentFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }
        if($request->readcodeFill && $request->readcodeFill !=='all'){
            //dd($request->readcodeFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','resulthpvs'])->where('hpv_code','!=',null)->where('read_code',$readcodeFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }
        if($startDate && $endDate && $ousentFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('read_code',$readcodeFill)
            ->paginate($perpage)->withQueryString();
        }
        else{
           // dd($request->perpage);
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','resulthpvs'])
        ->where('hpv_code','!=',null)
        ->paginate($perpage)->withQueryString();
        }
        $testElements = Testelement::where('testname_id',2)->select('id','name','element_group')->get();
        //dd($billtests);
        $provinces = Province::with('districts','wards')->get();
        $districts = District::get();
        $wards = Ward::get();

        $ousents = Ousent::select('id','name','logo')->get();
        $doctors = Doctor::with('ousent')->get();
        $readcodes = Ouread::get();
        // $nametests = Testname::select('id','name')->get();
        $nametests=TestnameResource::collection(Testname::get());
        $filters=[
            'ousentFill'=>$request->ousentFill,
        ];
        return Inertia::render('PrintResult/IndexHpv',[
            'billtests'=>$billtests,
            'nametests'=> $nametests,
            'testElements'=>$testElements,
            'provinces'=>$provinces,
            'districts'=>$districts,
            'wards'=>$wards,
            'ousents'=>$ousents,
            'doctors'=>$doctors,
            'readcodes'=>$readcodes,
            'filters'=>$filters,
            'custommer'=>Custommer::with('province')->get(),
        ]);
    }

    public function printMutiThin(Request $rq){

        $keys = collect($rq->all());
        $ids = $keys->keys();

        $billtests=Billtest::whereIn('id',$ids)->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->get();

        $billTudus = Billtest::whereIn('id',$ids)->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])
                ->where('ousent_id',1)
                ->get();
        //dd($billtests);
        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        return Inertia::render('PrintMulti/Index',
            [
                'billtests'=>$billtests,
                'billtudus'=>$billTudus,
                'testElements'=>$testElements,
            ]
        );
    }





    // public function printOne(Request $request){
    //     //dd($request->id);
    //     $billtests=Billtest::where('id',$request->id)->get();
    //     return $billtests;
    // }

    // public function showPrint(Request $request){
    //    // $perpage = $request->perpageFill?$request->perpageFill:5;
    //     //$ousentFill=$request->ousentFill?$request->ousentFill:'all';



    //     $billtests=Billtest::whereIn('id',$request->billId)->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->get();

    //     $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
    //     $provinces = Province::with('districts','wards')->get();
    //     $districts = District::get();
    //     $wards = Ward::get();
    //     $ousents = Ousent::select('id','name')->get();
    //     $doctors = Doctor::select('id','name','ousent_id')->get();

    //     $filters=[
    //         'ousentFill'=>$request->ousentFill,
    //     ];
    //    // dd($billtests);
    //     return Inertia::render('Prinview/Index',[
    //         'billtests'=>$billtests,
    //         'nametests'=>TestnameResource::collection(Testname::select('id','name')->get()),
    //         'testElements'=>$testElements,
    //         'provinces'=>$provinces,
    //         'districts'=>$districts,
    //         'wards'=>$wards,
    //         'ousents'=>$ousents,
    //         'doctors'=>$doctors,
    //         'filters'=>$filters,
    //         'custommer'=>Custommer::with('province')->get(),
    //     ]);
    // }
}
