<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Actions\UploadFile;
use App\Models\ImageThinprep;
use App\Http\Resources\ImageThinprepResource;

use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;

use Str;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Result/UploadImage',[
            'imageviews'=>ImageThinprepResource::collection(ImageThinprep::get()),


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
    public function store(Request $request,  UploadFile $uploadeFile)
    {

        if($request->hasFile('files')){
           // $pictures = [];
            foreach($request->file('files') as $file){


                make($file)->resize(30,30)->$uploadeFile->setFile( $file)
                ->setUploadPath((new ImageThinprep())->uploadFolderLeft())
                 ->executeImgaLeft();
                $filename = $file->getClientOriginalName();

                //$file->move(public_path('imageThinLeft'),$filename);
                //$pictures[] = $filename;
                $thinprep_code[] = substr($filename,0,-4);

                $findImage = ImageThinprep::where('thinprep_code',substr($filename,0,-4))->first();

                if($findImage){
                    ImageThinprep::Where('thinprep_code',substr($filename,0,-4))->update([
                       'thinLeft'=>'L_'.$filename
                     ]);
                }
                else{
                    ImageThinprep::create([
                        'thinprep_code'=>substr($filename,0,-4),
                        'thinLeft'=> 'L_'.$filename
                     ]);
                }

             }

        }

        return back()->withInput()->with('success','Add  successfully!');

    }
    public function storeRight(Request $request,  UploadFile $uploadeFile)
    {

        //dd($request->all());
        if($request->hasFile('files')){
            $pictures = [];
            foreach($request->file('files') as $file){

                $uploadeFile->setFile( $file)
                ->setUploadPath((new ImageThinprep())->uploadFolderRight())
                 ->executeImgaRight();
                $filename = $file->getClientOriginalName();
                //$file->move(public_path('imageThinLeft'),$filename);
                $pictures[] = $filename;
                $thinprep_code[] = substr($filename,0,-4);

                $findImage = ImageThinprep::where('thinprep_code',substr($filename,0,-4))->first();

                if($findImage){
                    ImageThinprep::Where('thinprep_code',substr($filename,0,-4))->update([
                       'thinRight'=>'R_'.$filename
                     ]);
                }
                else{
                    ImageThinprep::create([
                        'thinprep_code'=>substr($filename,0,-4),
                        'thinRight'=> 'R_'.$filename
                     ]);
                }


             }

        }

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
       // dd($id);
       $data = ImageThinprep::find($id);

//dd($data->thinLeft);

        if($data)
        {
            Storage::disk('local')->delete('public/ImageThinLeft/'.$data->thinLeft);
            Storage::disk('local')->delete('public/ImageThinRight/'.$data->thinRight);
            $data->delete();
            return back()->withInput()->with('success','Delete  successfully!');
        }
        else{
            return back()->withInput()->with('failure','Can not delete!');
        }

    }
}
