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
        array_map('unlink', glob(public_path()."/pdf/*.pdf"));
        return view('/pdfs');
    }
}
