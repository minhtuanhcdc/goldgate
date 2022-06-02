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

class CustommerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perpage = $request->perpageFill?$request->perpageFill:5;
        if($request->ousentFill){
            //dd($request->ousentFill);
            $billtests=Billtest::with(['custommer','doctor','ousent','testnames','province','district','ward','phone','results'])->where('ousent_id',$request->ousentFill)->paginate($perpage);
        //dd($billtests);
        }
        else{
        $billtests=Billtest::with(['custommer','doctor','ousent','testnames','province','district','ward','phone','results'])->paginate($perpage);

        }
        $testElements = Testelement::where('testname_id',1)->select('id','name','element_group')->get();
        //dd($billtests);
        $provinces = Province::with('districts','wards')->get();
        $districts = District::select('id','name','province_id')->get();
        $wards = Ward::select('id','name','district_id')->get();
        $ousents = Ousent::select('id','name')->get();
        $doctors = Doctor::select('id','name','ousent_id')->get();
        // $nametests = Testname::select('id','name')->get();
        // $nametests=TestnameResource::collection(Testname::select('id','name')->get());
        $filters=[
            'ousentFill'=>$request->ousentFill,

        ];

        return Inertia::render('Custommer/Index',[
            'billtests'=>$billtests,
            'nametests'=>TestnameResource::collection(Testname::select('id','name')->get()),
            'testElements'=>$testElements,
            'provinces'=>$provinces,
            'districts'=>$districts,
            'wards'=>$wards,
            'ousents'=>$ousents,
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCustommerRequest $request)
    {
        //dd($request->all());
        try{
            DB::beginTransaction();
            $data= $request->all();
            $custommer=Custommer::create($data);

            //$data['custommer_id']=$custommers->id;
            //`id`, `custommer_id`, `ousent_id`, `doctor_id`, `diagonose`,
            // `hpv_code`, `thinprep_code`, `sample_code`, `status`

            $Id_bill=$custommer->billtest()->insertGetId([
                'custommer_id'=>$custommer->id,
                'ousent_id'=>$request->ousent_id,
                'doctor_id'=>$request->doctor_id,
                'diagonose'=>$request->diagonose,
                'hpv_code'=>$request->hpv_code,
                'thinprep_code'=>$request->thinprep_code,
                'sample_code'=>$request->sample_code,
                'status'=>1,
                'created_at' => date('Y-m-d H:i:s'),
                ]);

                //dd($bill);
                Billname::insert([
                    'billtest_id'=>$Id_bill,
                    'testname_id'=>$request->testname_id,
                    'status'=>1,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                //custommer_id`, `province_id`, `district_id`, `ward_id
                Custommeraddress::insert([
                    'custommer_id'=>$custommer->id,
                    'province_id'=>$request->province_id,
                    'district_id'=>$request->district_id,
                    'ward_id'=>$request->ward_id,
                    'created_at' => date('Y-m-d H:i:s'),

                ]);


            DB::commit();
            return back()->withInput()->with('success','Add successfully!');
        }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
       return back()->withInput()->back()->with('success','Add  successfully!');
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
