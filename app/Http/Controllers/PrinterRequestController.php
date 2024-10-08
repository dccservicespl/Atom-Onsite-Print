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
        //dd($get_all_print_queues);
        $html = '';
        if (!empty($get_all_print_queues)) {
            foreach($get_all_print_queues as $printer){
                $html .= '<tr>
                            <td>' . date('m-d-Y', strtotime($printer['rec_date_time'])) . '
                            </td>
                            <td>' . $printer['print_file'] . '</td>
                            <td>' . $printer['page_no'] . '
                            </td>
                            <td>' . json_decode(get_users($printer['print_by_id']), true)['data'][0]['name'] . '
                            </td>
                            <td>' . generateStatusCode($printer['print_status']) . '
                            </td>
                            <td class="text-end">
                            <a class="btn btn-tertiary border-300 btn-sm me-1 text-600 text-end"
                                data-bs-placement="top" title="Print Now"
                                download="Print Now" data-bs-toggle="modal" data-bs-target="#printerModal">
                                <i class="bi bi-printer"></i>
                            </a>
                        </td>
                        <tr>';
            }
        }else{
            $html = '<tr><td colspan="6"><p class="text-danger text-center h5 p-5"> Data not found!</p></td></tr>';

        }
        return response()->json([
            'data' => $html
        ]);

    }
}
