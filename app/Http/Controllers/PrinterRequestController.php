<?php

namespace App\Http\Controllers;

use App\Helpers\ZplPrinterPrintHelper;
use Exception;
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
                                download="Print Now" data-printer-queues-id="' . ($printer['id']) . '" data-box-no="' . ($printer['page_no']) . '" data-printer-id="' . ($printer['printer_ip_id']) . '" data-store-id="' . ($printer['store_id']) . '" data-header-id="' . ($printer['order_header_id']) . '" id="printModal" data-name="' . ($printer['print_file']) . '" data-bs-toggle="modal" data-bs-target="#printerModal">
                                <i class="bi bi-printer"></i>
                            </a>
                        </td>
                        <tr>';
            }
        }else{
            $html = '<tr><td colspan="6"><p class="text-danger text-center h5 p-5">No data found!</p></td></tr>';

        }
        return response()->json([
            'data' => $html
        ]);

    }

    public function store_number_label(Request $request){
        $header_id = $request->input('header_id');
        $printer_id = $request->input('printer_id');
        $port = $request->input('port');
        $printer_queues_id = $request->input('printer_queues_id');

        $result = json_decode(store_number_print_content($header_id));

        try {
            if ($printer_id) {
                foreach($result->data as $value){
                    $zpl_message = "^XA
                                ^PW600
                                ^LL2400
                                ^FO0,120
                                ^A0R,550,600
                                ^FD{$value->store_code}^FS
                                ^XZ";
                    $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_id, $port);
                    session()->flash('success', 'Labels printed successfully.');
                    json_decode(printer_status_update($printer_queues_id));
                    return response()->json([
                        'success' => 'Labels printed successfully',
                        'print_response' => $print_response,
                        'header_id' => $header_id
                    ], 200);
                }
            } else {
                session()->flash('error', 'No Printer found.');
                return response()->json(['error' => "No Printer found."]);
            }
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function final_store_label(Request $request){
        $header_id = $request->input('header_id');
        $store_id = $request->input('store_id');
        $num_of_boxes = $request->input('box_no');
        // $printer_id = $request->input('printer_id');
        $printer_id = "192.168.254.254";
        $port = $request->input('port');
        $printer_queues_id = $request->input('printer_queues_id');

        $result = json_decode(final_store_label_print_content($header_id,$store_id,$num_of_boxes));

        try {
            if ($printer_id) {
                for ($i = 1; $i <= $num_of_boxes; $i++) {
                    $box_count = $i . "/" . $num_of_boxes;
                    $zpl_message = "^XA" .
                        "^PW600
                                    ^FO300,80
                                    ^A0R,300,300
                                    ^FD" . $result->data->store_name . "^FS
                                    ^FO10,80
                                    ^A0R,150,150
                                    ^FD" . $result->data->get_inv_date . "^FS
                                    ^FO10,900
                                    ^A0R,150,150
                                    ^FD" . $box_count . "^FS
                                    ^XZ";
                    $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_id, $port);
                }
                session()->flash('success', 'Labels printed successfully.');
                json_decode(printer_status_update($printer_queues_id));
                return response()->json([
                    'success' => 'Labels printed successfully',
                    'print_response' => $print_response,
                ], 200);
            } else {
                session()->flash('error', 'No Printer found.');
                return response()->json(['error' => "No Printer found."]);
            }
        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }

    }
}
