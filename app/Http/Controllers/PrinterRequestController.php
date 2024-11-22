<?php

namespace App\Http\Controllers;

use App\Helpers\ZplPrinterPrintHelper;
use App\Models\PrinterQueue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrinterRequestController extends Controller
{
    // public function printer_filter_section(Request $request){
    //     $rec_date_time = $request->rec_date_time;
    //     $print_by_id = $request->print_by_id;
    //     $printer_status = $request->printer_status;
    //     $get_all_print_queues = json_decode(printer_queues_data($rec_date_time, $print_by_id, $printer_status), true)['data'];
    //     // $get_all_print_queues_query =

    //     // if ($rec_date_time) {
    //     //     # code...
    //     // }
    //     $html = '';
    //     if (!empty($get_all_print_queues)) {
    //         foreach($get_all_print_queues as $printer){
    //             $html .= '<tr>
    //                         <td>' . date('m-d-Y', strtotime($printer['rec_date_time'])) . '
    //                         </td>
    //                         <td>' . $printer['print_file'] . '</td>
    //                         <td>' . $printer['page_no'] . '
    //                         </td>
    //                         <td>' . json_decode(get_users($printer['print_by_id']), true)['data'][0]['name'] . '
    //                         </td>
    //                         <td>' . generateStatusCode($printer['print_status']) . '
    //                         </td>
    //                         <td class="text-end">
    //                         <a class="btn btn-tertiary border-300 btn-sm me-1 text-600 text-end"
    //                             data-bs-placement="top" title="Print Now"
    //                             download="Print Now" data-printer-queues-id="' . ($printer['id']) . '" data-box-no="' . ($printer['page_no']) . '" data-printer-id="' . ($printer['printer_ip_id']) . '" data-store-id="' . ($printer['store_id']) . '" data-header-id="' . ($printer['order_header_id']) . '" id="printModal" data-name="' . ($printer['print_file']) . '" data-bs-toggle="modal" data-bs-target="#printerModal">
    //                             <i class="bi bi-printer"></i>
    //                         </a>
    //                     </td>
    //                     <tr>';
    //         }
    //     }else{
    //         $html = '<tr><td colspan="6"><p class="text-danger text-center h5 p-5">No data found!</p></td></tr>';

    //     }
    //     return response()->json([
    //         'data' => $html
    //     ]);

    // }

    public function printer_filter_section(Request $request){
        $rec_date_time = $request->rec_date_time ?? date('Y-m-d');
        $print_by_id = $request->print_by_id;
        $printer_status = $request->printer_status;

        $get_printer_queues = DB::table('printer_queues')->whereDate('rec_date_time', $rec_date_time);

        if ($print_by_id) {
            $get_printer_queues->where('print_by_id', $print_by_id);
        }
        if (!is_null($printer_status)) {
            $get_printer_queues->where('print_status', $printer_status);
        }

        $get_printer_data = $get_printer_queues->orderBy('id', 'DESC')->limit(25)->get();
        $html = '';
        if ($get_printer_data->isNotEmpty()) {
            foreach($get_printer_data as $printer) {
                $html .= '<tr>
                            <td>' . date('m-d-Y', strtotime($printer->rec_date_time)) . '</td>
                            <td>' . $printer->print_file . '</td>
                            <td>' . $printer->store_name . '</td>
                            <td>' . $printer->page_no . '</td>
                            <td>' . json_decode(get_users($printer->print_by_id), true)['data'][0]['name'] . '</td>
                            <td>' . generateStatusCode($printer->print_status, $printer->id) . '</td>
                            <td>';
                            if ($printer->print_status == 0) {
                                $html .='<button class="btn btn-outline-warning printer_response_msg" data-id="'.$printer->id.'">
                                    <i class="bi bi-bell"></i>
                                </button>';
                            }
                            $html .='</td>
                            <td class="text-end">
                                <a class="btn btn-outline-primary"
                                   data-bs-placement="top" title="Print Now"
                                   download="Print Now" data-printer-queues-id="' . $printer->id . '"
                                   data-box-no="' . $printer->page_no . '"
                                   data-printer-id="' . $printer->printer_ip_id . '"
                                   data-store-id="' . $printer->store_id . '"
                                   data-header-id="' . $printer->order_header_id . '"
                                   id="printModal" data-name="' . $printer->print_file . '"
                                   data-bs-toggle="modal" data-bs-target="#printerModal">
                                   <i class="bi bi-printer"></i>
                                </a>
                            </td>
                        </tr>';
            }
        } else {
            $html = '<tr><td colspan="8"><p class="text-400 text-center h2 p-5">No data found!</p></td></tr>';
        }

        return response()->json([
            'data' => $html
        ]);
    }

    public function store_number_label(Request $request){
        $header_id = $request->input('header_id');
        // $printer_id = $request->input('printer_id');
        $printer_ip = $request->input('printer_ip');
        $port = $request->input('port');
        $printer_queues_id = $request->input('printer_queues_id');

        $result = json_decode(store_number_print_content($header_id));

        try {
            if ($printer_ip) {
                foreach($result->data as $value){
                    $zpl_message = "^XA
                                ^PW600
                                ^LL2400
                                ^FO0,120
                                ^A0R,550,600
                                ^FD{$value->store_code}^FS
                                ^XZ";
                    $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);
                }
                $message = 'Final Store Label printed successfully.';
                session()->flash('success','Final Store Label printed successfully.');
                update_printer_ques($printer_queues_id, 1, "Final Store Label printed successfully.");
                return response()->json([
                    'success' => $message,
                    'print_response' => $print_response,
                    'header_id' => $header_id
                ], 200);
            } else {
                session()->flash('error', 'No Printer found.');
                return response()->json(['error' => "No Printer found."]);
            }
        } catch (\Throwable $th) {
            update_printer_ques($printer_queues_id, 0, $th->getMessage());
            session()->flash('error', $th->getMessage());
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function final_store_label(Request $request){
        $header_id = $request->input('header_id');
        $store_id = $request->input('store_id');
        $num_of_boxes = $request->input('box_no');
        $printer_ip = $request->input('printer_ip');
        $port = $request->input('port');
        $printer_queues_id = $request->input('printer_queues_id');

        $result = json_decode(final_store_label_print_content($header_id,$store_id,$num_of_boxes));

        try {
            if ($printer_ip) {
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
                    $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);
                }
                update_printer_ques($printer_queues_id, 1, "Labels printed successfully");
                session()->flash('success', 'Labels printed successfully.');
                return response()->json([
                    'success' => 'Labels printed successfully',
                    'print_response' => $print_response,
                ], 200);
            } else {
                session()->flash('error', 'No Printer found.');
                return response()->json(['error' => "No Printer found."]);
            }
        } catch (\Throwable $th) {
            update_printer_ques($printer_queues_id, 0, $th->getMessage());
            session()->flash('error', $th->getMessage());
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function printer_queue_api_check(Request $request, $recDateTime = NULL, $printById = NULL, $printStatus = NULL){
        $get_max_parent_id = PrinterQueue::max('parent_id');

        if (!$get_max_parent_id) {
            $get_max_parent_id = 0;
        }
        $get_all_print_queues = json_decode(printer_queues_data($get_max_parent_id), true)['data'];
        // dd($get_all_print_queues);

        $record_count = count($get_all_print_queues);
        if ($record_count>0) {
            $item = $get_all_print_queues[0];
            $insert_data_printer_queue = new PrinterQueue();
            $insert_data_printer_queue->store_id = $item['store_id'];
            $insert_data_printer_queue->parent_id = $item['id'];
            $insert_data_printer_queue->rec_date_time = $item['rec_date_time'];
            $insert_data_printer_queue->print_file = $item['print_file'];
            $insert_data_printer_queue->printer_ip_id = $item['printer_ip_id'];
            $insert_data_printer_queue->order_header_id = $item['order_header_id'];
            $insert_data_printer_queue->print_by_id = $item['print_by_id'];
            $insert_data_printer_queue->page_no = $item['page_no'];
            $insert_data_printer_queue->print_status = $item['print_status'];
            $insert_data_printer_queue->api_end_point = $item['api_end_point'];
            $insert_data_printer_queue->store_name = $item['store_name'];
            $insert_data_printer_queue->save();
            return response()->json([
                'response' => 201,
                "message" => "Success",
                "count" => $record_count
            ]);
        }else{
            return response()->json([
                'response' => 401,
                "message" => "Error",
                "count" => $record_count
            ]);
        }

    }

    public function delete_printer_queues(Request $request){
        $ids = $request->input('ids');

        if ($ids) {
            PrinterQueue::whereIn('id', $ids)->delete();
            $result = delete_printer_queues($ids);
        }

        session()->flash('success', 'Data deleted successfully.');
        return response()->json([
            'success' => 'Data deleted successfully.',
            'result' => $result,
            'ids' => $ids
        ], 200);

    }

    public function show_printer_response_msg($id = NULL){
        $get_printer_response_msg = PrinterQueue::where('id', $id)->first()->printer_response;
        return response()->json([
            'response' => 200,
            'message' => "Seccess",
            'data' => $get_printer_response_msg
        ]);
    }

}
