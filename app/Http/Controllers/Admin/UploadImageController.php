<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Actions\UploadFile;
use App\Models\ImageThinprep;
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
            'imageviews'=>ImageThinprep::get(),
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
            $pictures = [];
            foreach($request->file('files') as $file){

                $uploadeFile->setFile( $file)
                ->setUploadPath((new ImageThinprep())->uploadFolderLeft())
                 ->executeOrigin();
                $filename = $file->getClientOriginalName();
                //$file->move(public_path('imageThinLeft'),$filename);
                $pictures[] = $filename;
                $thinprep_code[] = substr($filename,0,-4);
                ImageThinprep::create([
                    'thinprep_code'=>substr($filename,0,-4),
                    'thinLeft'=> $filename
                 ]);

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
        //
    }
}
