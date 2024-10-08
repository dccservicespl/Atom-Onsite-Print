<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrinterRequestController extends Controller
{
    public function printer_filter_section(Request $request){
        $rec_date_time = $request->rec_date_time;
        $print_by_id = $request->print_by_id;
        $printer_status = $request->printer_status;
        $get_all_print_queues = json_decode(printer_queues_data($rec_date_time, $print_by_id, $printer_status), true)['data'];
        dd($get_all_print_queues);
    }
}
