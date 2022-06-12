<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
//use Barryvdh\DomPDF\Facade as PDF;
use Inertia\Inertia;
use App\Models\Billtest;
use Dompdf\Dompdf;
use Dompdf\Options;
//require_once 'dompdf/autoload.inc.php';
class PDFController extends Controller
{
    public function TransBillId(Request $r){
     // dd($r->all());
      $this->downloadPDF($r->all());
    }

    public function downloadPDF(Request $r){
     // dd($r->all());
      $fruits = collect($r->all());

      $keys = $fruits->keys();
     //dd($keys);
      $billtests=Billtest::whereIn('id',$keys)->with(['custommer','doctor','ousent','testnames','district','ward','imageLeft','results'])->get();
      $hello = 1;
      //dd($billtests);

      $pdf = PDF::loadView('printView.Index', [
        'billtests'=>$billtests,
        'ousent'=>3,

      ]);

      //$pdf->setPaper('A4', 'landscape');
     $pdf->setPaper('A4', 'portrait');

     //$pdf->render();
     return $pdf->stream();
     //return $pdf->stream('Leito.pdf');

      }
}
