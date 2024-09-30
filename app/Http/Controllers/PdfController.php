<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use App\Models\Demande;
use App\Models\Traitement;
use App\Models\Approbateur;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;



class PdfController extends Controller
{
    public function generatePDF()
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml('');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->stream('document.pdf');
    }
    public function index()
    {

        $pdf = Demande::with('demande_details')->get()->first();
        return view('generatePdf.index', compact('pdf'));
    }

    public function generate(Request $request, Demande $demande)
    {
        $last_flow = Traitement::where('demande_id', $demande->id)->orderBy('id', 'desc')->first();
        $flows_datas = [];
        $service= [];
        if($last_flow->status !== 'en_cours') {
            $flows = Traitement::where('demande_id', $demande->id)->get();
            foreach($flows as $flow) {
                $user_validator = User::find($flow->approbateur_id);
                $validator = Approbateur::where('email',$user_validator->email)->first();
                if($validator === null){
                    $services[] = [
                        'validator' => $user_validator->name,
                        'status' => $flow->status,
                    ];
                } else {
                    $flows_datas[] = [
                        'validator' => $validator->name,
                        'function' => $validator->fonction,
                        'status' => $flow->status,
                    ];
                }
            }
        }
        $demande['services'] = $services;
        $demande['flows'] = $flows_datas;

        $html = view('generatepdf.index', compact('demande'))->render();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream("$demande->numero.pdf");
    }
}
