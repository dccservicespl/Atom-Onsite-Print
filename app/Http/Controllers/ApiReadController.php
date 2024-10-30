<?php

namespace App\Http\Controllers;

use App\Helpers\ZplPrinterPrintHelper;
use Exception;
use Illuminate\Http\Request;

class ApiReadController extends Controller
{
    public function printer_queues_data(Request $request) {}

    public function store_label_print(Request $request)
    {
        // $header_id = $request->input('header_id');
        // $store_details = $request->input('store_details');
        // $printer_ip = $request->input('printer_ip');
        // $port = $request->input('port');

        // try {
        //     if ($printer_ip) {
        //         $zpl_message = "^XA
        //                     ^PW600
        //                     ^LL2400
        //                     ^FO0,120
        //                     ^A0R,550,600
        //                     ^FD{$store_details}^FS
        //                     ^XZ";
        //         $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);

        //         return response()->json([
        //             'success' => 'Labels printed successfully',
        //             'print_response' => $print_response,
        //             'header_id' => $header_id
        //         ], 200);
        //     } else {
        //         return response()->json(['error' => "No Printer found."]);
        //     }
        // } catch (Exception $e) {
        //     return response()->json(['error' => $e->getMessage()]);
        // }

        try {
            if ($request->user_id === env('API_USER_ID') && $request->password === env('API_USER_PASSWORD')) {
                $header_id = $request->input('header_id');
                $store_details = $request->input('store_details');
                $printer_ip = $request->input('printer_ip');
                $port = $request->input('port');

                if ($printer_ip) {
                    $zpl_message = "^XA
                            ^PW600
                            ^LL2400
                            ^FO0,120
                            ^A0R,550,600
                            ^FD{$store_details}^FS
                            ^XZ";
                    $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);

                    return response()->json([
                        'success' => 'Labels printed successfully',
                        'print_response' => $print_response,
                        'header_id' => $header_id
                    ], 200);
                } else {
                    return response()->json(['error' => "No Printer found."]);
                }
            } else {
                return response()->json([
                    'response' => 401,
                    'message' => 'Authorization Fail!',
                    'data' => 'No data Found!'
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'response' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function final_store_label_print(Request $request)
    {
        $header_id = $request->input('header_id');
        $store_details = $request->input('store_details');
        $store_id = $request->input('store_id');
        $num_of_boxes = $request->input('num_of_boxes');
        $get_inv_date = $request->input('get_inv_date');
        $printer_ip = $request->input('printer_ip');
        $port = $request->input('port');

        try {
            if ($printer_ip) {
                for ($i = 1; $i <= $num_of_boxes; $i++) {
                    $box_count = $i . "/" . $num_of_boxes;
                    $zpl_message = "^XA" .
                        "^PW600
                                    ^FO300,80
                                    ^A0R,300,300
                                    ^FD" . $store_details . "^FS
                                    ^FO10,80
                                    ^A0R,150,150
                                    ^FD" . date('mdY', strtotime($get_inv_date)) . "^FS
                                    ^FO10,900
                                    ^A0R,150,150
                                    ^FD" . $box_count . "^FS

                                    ^XZ";
                    $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);
                }
                return response()->json([
                    'success' => 'Labels printed successfully',
                    //'print_response' => $print_response,
                    'header_id' => $header_id,
                    'store_id' => $store_id,
                ], 200);
            } else {
                return response()->json(['error' => "No Printer found."]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        // try {
        //     if ($request->user_id === env('API_USER_ID') && $request->password === env('API_USER_PASSWORD')) {
        //         $header_id = $request->input('header_id');
        //         $store_details = $request->input('store_details');
        //         $store_id = $request->input('store_id');
        //         $num_of_boxes = $request->input('num_of_boxes');
        //         $get_inv_date = $request->input('get_inv_date');
        //         $printer_ip = $request->input('printer_ip');
        //         $port = $request->input('port');

        //         if ($printer_ip) {
        //             $print_response = '';
        //             for ($i = 1; $i <= $num_of_boxes; $i++) {
        //                 $box_count = $i . "/" . $num_of_boxes;
        //                 $zpl_message = "^XA" .
        //                     "^PW600
        //                                 ^FO300,80
        //                                 ^A0R,300,300
        //                                 ^FD" . $store_details . "^FS
        //                                 ^FO10,80
        //                                 ^A0R,150,150
        //                                 ^FD" . date('mdY', strtotime($get_inv_date)) . "^FS
        //                                 ^FO10,900
        //                                 ^A0R,150,150
        //                                 ^FD" . $box_count . "^FS

        //                                 ^XZ";
        //                 $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);
        //             }
        //             return response()->json([
        //                 'success' => 'Labels printed successfully',
        //                 'print_response' => $print_response,
        //                 'header_id' => $header_id,
        //                 'store_id' => $store_id,
        //             ], 200);
        //         } else {
        //             return response()->json(['error' => "No Printer found."]);
        //         }
        //     } else {
        //         return response()->json([
        //             'response' => 401,
        //             'message' => 'Authorization Fail!',
        //             'data' => 'No data Found!'
        //         ], 401);
        //     }
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'response' => 500,
        //         'message' => $th->getMessage(),
        //     ], 500);
        // }
    }

    
}
