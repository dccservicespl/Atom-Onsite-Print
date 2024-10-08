<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrinterRequestController extends Controller
{
    public function printer_filter_section(Request $request){
        dd($request->all());
    }
}
