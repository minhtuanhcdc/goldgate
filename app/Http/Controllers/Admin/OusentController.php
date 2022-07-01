<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Ousent;
use App\Http\Resources\OusentResource;
use App\Http\Requests\SaveOuRequest;
use App\Actions\UploadFile;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;

class OusentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       // $ousents = Ousent::paginate(2);
        //dd($ousents);

        //$ousents=OusentResource::collection(Ousent::simplePaginate(10));

        return Inertia::render('Ousent/Index',[

            'ousents'=>Ousent::paginate(10)
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
    public function store(Request $request, UploadFile $uploadeFile)
    {
        //dd($request->all());
        // $data= $request->all();
        // Ousent::create($data);
        //dd($request->file('logo'));
        try{
            DB::beginTransaction();
            $data=
            [
               'name'=> $request->name,
               'address'=> $request->address,
               'phone'=> $request->phone,
               'id_ou'=> $request->id_ou,
               'person_contact'=> $request->person_contact,
            ];
            //$data= $request->all();
            //dd($data);
             $data['logo']=$uploadeFile->setFile($request->file('logo'))
            ->setUploadPath((new Ousent())->uploadFolder())
             ->execute();

           $ousents= Ousent::create($data);
           //Ousent::create($data);

            DB::commit();
            return redirect()->route('ousents.index')->with('success','Add successfully!');
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
        dd(123);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Ousent $ousent, UploadFile $uploadeFile)
    {
        //$request->session()->put('url.intended',url()->previous());
        try{
            DB::beginTransaction();
            $data=$request->all();
            // $data=
            // [
            //    'name'=> $request->name,
            //    'address'=> $request->address,
            //    'phone'=> $request->phone,
            //    'id_ou'=> $request->id_ou,
            //    'person_contact'=> $request->person_contact,
            // ];
            if ($request->file('logo')) {
                $ousent->deleteImage();
                    $data['logo']=$uploadeFile->setFile($request->file('logo'))
                    ->setUploadPath((new Ousent())->uploadFolder())
                    ->execute();
            }
            $ousent=$ousent->update($data);
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

        public function destroy(Ousent $ousent)
        {
            //dd($ousent);
            $ousent->deleteImage();
            $ousent->delete();
            return redirect()->route('ousents.index')->with('success', "Deleted successfully!");
        }

}
