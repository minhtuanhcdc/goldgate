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
use PHPUnit\Exception;
use Illuminate\Support\Facades\Log;
use DB;
use \Illuminate\Support\Str;

class InputInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $perpage = $request->perPage?$request->perPage:5;
        $ousentFill=$request->ousentFill?$request->ousentFill:'all';
        $readcodeFill=$request->readcodeFill?$request->readcodeFill:'all';
        $startDate=$request->startDate?$request->startDate:'';
        $endDate=$request->endDate?$request->endDate:'';

        $query = Billtest::query();

        if (request('term')) {
         $query
             ->where('hpv_code', 'like', '%' . request('term') . '%')
             ->orWhere('thinprep_code', 'like', '%' . request('term') . '%');
             //->orWhere('id', 'like', '%' . request('term') . '%');
     }

        if($request->ousentFill && $request->ousentFill !=='all'){
           // dd($request->ousentFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->where('ousent_id',$ousentFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }

        if($request->readcodeFill && $request->readcodeFill !=='all'){
            //dd($request->readcodeFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->where('read_code',$readcodeFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }
        if($startDate && $endDate && $ousentFill){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])
            ->whereDate('date_receive','>=',$startDate)
            ->whereDate('date_receive','<=',$endDate)
            ->where('read_code',$readcodeFill)
            ->paginate($perpage)->withQueryString();
        }
        // else{
        //    // dd($request->perpage);
        // $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->paginate($perpage)->withQueryString();
        // }
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
        return Inertia::render('InputInfo/Index',[
            //'billtests'=>$billtests,
            'billtests'=>fn() => $query->with(['custommer','doctor','ousent','testnames','resulthpvs'])->where('hpv_code','!=',null)->paginate(10)->withQueryString(),
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
