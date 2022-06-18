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

    public function updatebill(Request $request, Billtest $billtest){
        //dd($request->all());

        //$billtest->update($request->all());


         // $role->permissions()->sync($request->menuselected);
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
            'userupdate_id'=>Auth()->user()->id,
            'updated_at'=>date('Y-m-d H:i:s'),
           ]);

           Billname::where('billtest_id',$request->id)->delete();

        //    Billname::insert([
        //     'billtest_id'=>$request->id,
        //     'testname_id'=>$request->testname_id,
        //     'status'=>2,
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
        foreach($request->testname_id as $key=>$value){
            Billname::insert([
                'billtest_id'=>$request->id,
                'testname_id'=>$value,
                'status'=>2,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        //$billtest->billnametests()->synch($request->testname_id);
            DB::commit();
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
    return back()->withInput()->with('success','Add  successfully!');
    }


}
