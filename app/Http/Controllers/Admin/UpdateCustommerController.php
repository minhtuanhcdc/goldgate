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


class UpdateCustommerController extends Controller
{

    public function ousent(Request $request){
        //dd($request->id);
        try{
            DB::beginTransaction();
            $data=$request->all();
           $billtestUpdate=Billtest::where('id',$request->id)->update([
            'custommer_id'=>$request->custommer_id,
            'ousent_id'=>$request->ousent_id,
            'doctor_id'=>$request->doctor_id,
            'hpv_code'=>$request->hpv_code,
            'thinprep_code'=>$request->thinprep_code,
            'sample_code'=>$request->sample_code,
            'para'=>$request->para,
            'kinhchot'=>$request->kinhchot,
            'diagnose'=>$request->diagnose,
            'status'=>$request->status,
            //`result_status`=>$request->result_status,
            'updated_at'=>date('Y-m-d H:i:s'),
           ]);

           //$custommer->billtest()->attach($request->custommer_id);

            DB::commit();

            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
    return back()->withInput()->with('success','Add  successfully!');
    }
}
