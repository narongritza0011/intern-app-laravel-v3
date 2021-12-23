<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmitDocumentController extends Controller
{
    public function store(Request $request)
    {

       // dd($request->all());
        dd($request->profile,$request->id_File, $request->full_name_File,$request->phone_File);
    }
}
