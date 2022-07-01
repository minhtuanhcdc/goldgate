<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

use Inertia\Inertia;

use App\Http\Resources\ImagethinResource;

use App\Models\Imagethin;
use Storage;
use Str;
use App\Actions\UploadFile;
use Auth;

class ImagethinController extends Controller
{
    public function index()
    {
//dd(Imagethin::get());
        return Inertia::render('Result/UploadImage',[
            'imageviews'=> ImagethinResource::collection(Imagethin::get()),
        ]);
    }

    public function storeLeft(Request $request,  UploadFile $uploadeFile)
    {

        if($request->hasFile('files')){
            $pictures = [];
            foreach($request->file('files') as $file){

                $uploadeFile->setFile( $file)
                ->setUploadPath((new Imagethin())->uploadFolderLeft())
                 ->executeImgaLeft();
                $filename = $file->getClientOriginalName();
                //$file->move(public_path('imageThinLeft'),$filename);
                $pictures[] = $filename;
                $thinprep_code[] = substr($filename,0,-4);

                $findImage = Imagethin::where('thinprep_code',substr($filename,0,-4))->first();

                if($findImage){
                    Imagethin::Where('thinprep_code',substr($filename,0,-4))->update([
                       'thinLeft'=>'L_'.$filename
                     ]);
                }
                else{
                    Imagethin::create([
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
                ->setUploadPath((new Imagethin())->uploadFolderRight())
                 ->executeImgaRight();
                $filename = $file->getClientOriginalName();
                //$file->move(public_path('imageThinLeft'),$filename);
                $pictures[] = $filename;
                $thinprep_code[] = substr($filename,0,-4);

                $findImage = Imagethin::where('thinprep_code',substr($filename,0,-4))->first();

                if($findImage){
                    Imagethin::Where('thinprep_code',substr($filename,0,-4))->update([
                       'thinRight'=>'R_'.$filename
                     ]);
                }
                else{
                    Imagethin::create([
                        'thinprep_code'=>substr($filename,0,-4),
                        'thinRight'=> 'R_'.$filename
                     ]);
                }


             }

        }

        return back()->withInput()->with('success','Add  successfully!');

    }
    public function detroyLeft($id){


        $image = Imagethin::findOrFail($id);

        Storage::delete('public/storage/ImageThinLeft'.$image->thinLeft);
        Storage::disk('public')->delete('/storage/ImageThinLeft'.$image->thinRight);

        $image->delete();

        return back()->withInput()->with('success','Add  successfully!');
    }
}
