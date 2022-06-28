<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
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
use App\Http\Requests\SaveResultRequest;
use App\Http\Resources\TestnameResource;
use DB;

class InputHpvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         $perpage = $request->perpageFill?$request->perpageFill:10;
         $ousentFill=$request->ousentFill?$request->ousentFill:"all";
       $startDate=$request->startDate?$request->startDate:'';
       $endDate=$request->endDate?$request->endDate:'';

       $query = Billtest::query();

       if (request('term')) {
        $query
            ->where('hpv_code', 'like', '%' . request('term') . '%');
            //->orWhere('hpv_code', 'like', '%' . request('term') . '%');
            //->orWhere('id', 'like', '%' . request('term') . '%');
    }

    // if ($request->has(['ousentFill','startDate']) && $request->ousentFill != null) {
    //     $query->where('ousent_id',$request->ousentFill)
    //     ->whereDate('date_receive',$request->startDate);

    // }
    // if ($request->has(['ousentFill','startDate']) && $request->ousentFill != null) {
    //     $query->where('ousent_id',$request->ousentFill)
    //     ->whereDate('date_receive',$request->startDate);
    // }
    // if ($request->has(['ousentFill','startDate','endDate']) && $request->ousentFill != null) {
    //     $query->where('ousent_id',$request->ousentFill)
    //     ->whereDate('date_receive',$request->startDate)
    //     ->whereDate('date_receive','>=',$request->startDate)
    //     ->whereDate('date_receive','<=',$request->endDate);

    // }

        if($request->ousentFill && $request->ousentFill !=="all"){
            $query
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$request->ousentFill);

        }
        if($request->startDate){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive',$request->startDate)
            ->paginate($perpage)->withQueryString();

        }
        if($request->endDate){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive',$request->endDate)
            ->paginate($perpage)->withQueryString();
        }
        if($request->startDate && $request->endDate){
            // $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','resulthpvs'])
            // ->where('hpv_code','!=',null)
            // ->whereDate('date_receive','>=',$request->startDate)
            // ->whereDate('date_receive','<=',$request->endDate)
            // ->paginate($perpage)->withQueryString();
            $query
            ->where('hpv_code','!=',null)
            //->whereDate('date_receive','<=',$request->startDate)
            //->whereDate('date_receive','<=',$request->endDate);
            ->whereBetween('date_receive',[$request->startDate,$request->endDate]);
            //->paginate($perpage)->withQueryString();
        }
        if(($request->ousentFill && $request->ousentFill !=="all")&& ($request->startDate && $request->endDate) ){
            $query
            ->where('hpv_code','!=',null)
            ->where('ousent_id',$request->ousentFill)
            ->whereBetween('date_receive',[$request->startDate,$request->endDate]);
            // $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','resulthpvs'])
            // ->where('hpv_code','!=',null)
            // ->where('ousent_id',$request->ousentFill)
            // ->whereDate('date_receive','>=',$request->startDate)
            // ->whereDate('date_receive','<=',$request->endDate)
            // ->paginate($perpage)->withQueryString();
         }
        if(($request->startDate && $request->endDate) && ($request->ousentFill =="all")){
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','resulthpvs'])
            ->where('hpv_code','!=',null)
            ->whereDate('date_receive','>=',$request->startDate)
            ->whereDate('date_receive','<=',$request->endDate)
            ->paginate($perpage)->withQueryString();
        }

        // else{
        //     $billtests=Billtest::with(['custommer','doctor','ousent','testnames','resulthpvs'])->where('hpv_code','!=',null)->paginate($perpage)->withQueryString();
        // }


        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        $testElementsHpv = Testelement::where('testname_id',2)->select('id','name','element_group')->get();
        //dd($testElementsHpv);
        $ousents = Ousent::select('id','name')->get();
        $readcodes = Ouread::get();
        $doctors = Doctor::select('id','name','ousent_id')->get();
        $filters=[
            'ousentFill'=>$request->ousentFill,
        ];
        return Inertia::render('Result/IndexHpv',[
           // 'billtests'=>$billtests,
           'billtests'=>fn() => $query->with(['custommer','doctor','ousent','testnames','resulthpvs'])->where('hpv_code','!=',null)->paginate(10)->withQueryString(),
            'ousents'=>$ousents,
            'testElements'=>$testElements,
            'testElementsHpv'=>$testElementsHpv,
            'doctors'=>$doctors,
            'readcodes'=>$readcodes,
            'filters'=>$filters,
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
        //dd($request->all());

        foreach ($request->elment_hpv as $eid=>$value) {
            if($value!==null){
                Result::insert([
                    'bill_id'=>$request->bill_id,
                    'hpv_code'=>$request->hpv_code,
                    'element_id'=>$eid,
                    'result'=>$value,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    ]);
            };
            }
            Billtest::where('hpv_code',$request->hpv_code)->update(
                [
                    'resultHpv'=>1
                ]
                );

        return back()->withInput()->with('success','Add  successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
       //dd($request->all());
       Result::where('hpv_code',$request->hpv_code)->delete();
       foreach ($request->elment_hpv as $eid=>$value) {
        if($value!==null){
            Result::insert([
                'bill_id'=>$request->bill_id,
                'hpv_code'=>$request->hpv_code,
                'element_id'=>$eid,
                'result'=>$value,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                ]);
        };

        Billtest::where('hpv_code',$request->hpv_code)
            ->update([
                'resultHpv'=>1
            ]);
    }
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
