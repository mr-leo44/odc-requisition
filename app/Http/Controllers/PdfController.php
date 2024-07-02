<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Demande;
use Illuminate\Http\Request;
use App\Models\DemandeDetail;
use Barryvdh\DomPDF\Facade\Pdf;



class PdfController extends Controller
{
    public function generatePDF(){
        $dompdf = new Dompdf();
        $dompdf->loadHtml('');
        $dompdf->setPaper('A4','portrait');
        $dompdf->stream('document.pdf');
        

    }
    public function index(){
        $pdf = Demande::with('demande_details')->get()->first();
        return view('generatePdf.index' , compact('pdf'));
    }
    
    public function generate()
    {
        
        $pdf = Demande::with('demande_details')->get()->first();
        $html = view('generatePdf.index', compact('pdf'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        return $dompdf->stream('document.pdf');
    }
}

