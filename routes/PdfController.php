<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index()
    {
        return view('pdfs');
    }

    public function Clear()
    {
    	$path = '/home/srv35437/domains/rel.deadygo.com/public/pdf/';
        array_map('unlink', glob($path."*.pdf"));
        return view('/pdfs');
    }
}
