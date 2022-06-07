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
        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        //$testElements = Testelement::where('testname_id',1)->with('valueresult')->get();
        //$userId = 44;
// Event::with(["owner", "participants" => function($q) use($userId ){
//     $q->where('participants.IdUser', '=', 1);
        $filters=[
            'ousentFill'=>$request->ousentFill,
        ];

        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','results'])->paginate($perpage);
        $ousents = Ousent::select('id','name')->get();
        $doctors = Doctor::select('id','name','ousent_id')->get();

        return Inertia::render('Result/Index',[
            'billtests'=>$billtests,
            'ousents'=>$ousents,
            'testElements'=>$testElements,
            'doctors'=>$doctors,
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
        // foreach($request->element_id as $ied=>$value){
        //     Result::insert([
        //         'bill_id'=>$request->bill_id,
        //         'thin_code'=>$request->thin_code,
        //         'element_id'=>$value,
        //         'result'=>$ied,
        //         'created_at'=>date('Y-m-d H:i:s'),
        //         'updated_at'=>date('Y-m-d H:i:s'),
        //     ]);
        //};

                foreach ($request->element_id as $eid=>$value) {
                    Result::insert([
                        'bill_id'=>$request->bill_id,
                        'thin_code'=>$request->thin_code,
                        'element_id'=>$value,
                        'result'=>$request->ketluan_conclution,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'updated_at'=>date('Y-m-d H:i:s'),
                        ]);
            };
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
