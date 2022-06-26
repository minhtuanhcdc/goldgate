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
use App\Models\Result;
use App\Http\Requests\SaveCustommerRequest;
use App\Http\Requests\SaveResultRequest;
use App\Http\Resources\TestnameResource;
use DB;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = $request->perpageFill?$request->perpageFill:10;
        $ousentFill=$request->ousentFill?$request->ousentFill:'all';
        $readcodeFill=$request->readcodeFill?$request->readcodeFill:'all';
        if($request->ousentFill && $request->ousentFill !=='all'){
           // dd($request->ousentFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','results'])->where('thinprep_code','!=',null)->where('ousent_id',$ousentFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }
        if($request->readcodeFill && $request->readcodeFill !=='all'){
           // dd($request->ousentFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','district','results'])->where('thinprep_code','!=',null)->where('read_code',$readcodeFill)->paginate($perpage)->withQueryString();
                //dd($billtests);
        }

        else{
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','results'])->where('thinprep_code','!=',null)->paginate($perpage);
        }

        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        $testElementsHpv = Testelement::where('testname_id',2)->select('id','name','element_group')->get();
        //dd($testElementsHpv);
        $ousents = Ousent::select('id','name')->get();
        $readcodes = Ouread::get();
        $doctors = Doctor::select('id','name','ousent_id')->get();
        $filters=[
            'ousentFill'=>$request->ousentFill,
        ];
        return Inertia::render('Result/Index',[
            'billtests'=>$billtests,
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
                foreach ($request->element_id as $eid=>$value) {
                    if($value!==null){
                        Result::insert([
                            'bill_id'=>$request->bill_id,
                            'thin_code'=>$request->thin_code,
                            'element_id'=>$value,
                            'result'=>$value,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                            ]);
                    };
                    }
                    Result::insert([
                        'element_id'=>26,
                        'result'=>$request->ket_luan,
                        'bill_id'=>$request->bill_id,
                        'thin_code'=>$request->thin_code,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        ]);

            Billtest::where('id',$request->bill_id)->update(
                [
                    'result_status'=>1
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
      // dd($request->all());
       Result::where('bill_id',$id)->delete();
       foreach ($request->element_id as $eid=>$value) {
                if($value != 26){

                    Result::insert([
                        'bill_id'=>$id,
                        'thin_code'=>$request->thinprep_code,
                        'element_id'=>$value,
                        'result'=>$value,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        ]);
                };
                if($value == 26){
                    Result::insert([
                        'bill_id'=>$id,
                        'thin_code'=>$request->thinprep_code,
                        'element_id'=>26,
                        'result'=>$request->ketluan,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        ]);
                }

        }
        // Result::insert([
        //     'element_id'=>26,
        //     'result'=>$request->ketluan,
        //     'bill_id'=>$id,
        //     'thin_code'=>$request->thin_code,
        //     'created_at'=>date('Y-m-d H:i:s'),
        //     'updated_at'=>date('Y-m-d H:i:s'),
        //     ]);

            return back()->withInput()->with('success','Add  successfully!');
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
