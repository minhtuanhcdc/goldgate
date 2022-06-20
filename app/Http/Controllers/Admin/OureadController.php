<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Ouread;
use DB;
use Storage;
use App\Http\Requests\SaveOureadRequest;
use App\Actions\UploadFile;
use PHPUnit\Exception;

class OureadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ouread = Ouread::get();

        return Inertia::render('ReadSample/Index',[
            'oureads'=>$ouread
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
    public function store(SaveOureadRequest $request)
    {
        try{
            DB::beginTransaction();
            $data=
            [
               'name'=> $request->name,
               'read_code'=> $request->read_code,
               'phone'=> $request->phone,
               'status'=> $request->status,

            ];


           $ousents= Ouread::create($data);
           //Ousent::create($data);

            DB::commit();
            return redirect()->back()->with('success','Add  successfully!');
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }

       return redirect()->back()->with('success','Add  successfully!');
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
    public function update(Request $request, Ouread $ouread)
    {
        try{
            DB::beginTransaction();
            $data=$request->all();

            $ouread->update($data);
            DB::commit();
            return back()->withInput()->with('success','Updated successfully!');
            }catch(Exception $excepton){
                DB::rollBack();
                Log::error('Message:'.$excepton->getMessage().'---Line:'.$excepton->getLine());
            }
       return back()->withInput()->with('success','Update successfully!');
       //return back()->withInput()->with('success','Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ouread $ouread)
    {
       // dd($id);
        $ouread->delete();
        return redirect()->back()->with('success','Delete  successfully!');
    }
}
