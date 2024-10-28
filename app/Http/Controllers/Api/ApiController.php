<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ZplPrinterPrintHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function final_store_label_print(Request $request){
        try {
            if ($request->user_id === env('API_USER_ID') && $request->password === env('API_USER_PASSWORD')) {
                $store_details = $request->store_name;
                $printer_ip = $request->printer_ip;
                $port = $request->port;
                $num_of_boxes = $request->num_of_boxes;
                $inv_date = $request->inv_date;

                if (empty($inv_date) || empty($store_details) || empty($printer_ip) || empty($num_of_boxes) || empty($port)) {
                    return response()->json([
                        'response' => 400,
                        'message' => 'The parameters should not be null (store_name,printer_ip,port,num_of_boxes,inv_date)',
                        'count' => 0,
                        'data' => null
                    ], 400);
                }

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
                                        ^FD" . date('mdY', strtotime($inv_date)) . "^FS
                                        ^FO10,900
                                        ^A0R,150,150
                                        ^FD" . $box_count . "^FS

                                        ^XZ";
                        $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);
                    }
                } else {
                    return response()->json(['error' => "No Printer found."]);
                }
                return response()->json([
                    'response' => 201,
                    'message' => 'Successfully fetched the data.',
                    'count' => $num_of_boxes,
                ], 201);
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
                'data' => 'No data Found!'
            ], 500);
        }
    }
    public function store_label_print(Request $request){
        try {
            if ($request->user_id === env('API_USER_ID') && $request->password === env('API_USER_PASSWORD')) {

                $header_id = $request->header_id;
                $printer_ip = $request->printer_ip;
                $port = $request->port;
                $result = json_decode(store_number_print_content($header_id));
                if (empty($header_id) || empty($printer_ip) || empty($port)) {
                    return response()->json([
                        'response' => 400,
                        'message' => 'The parameters should not be null (store_name,printer_ip,port,num_of_boxes,inv_date)',
                        'count' => 0,
                        'data' => null
                    ], 400);
                }

                if ($printer_ip) {
                    foreach($result->data as $value){
                        $zpl_message = "^XA
                                    ^PW600
                                    ^LL2400
                                    ^FO0,120
                                    ^A0R,550,600
                                    ^FD{$value->store_code}^FS
                                    ^XZ";
                        ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);
                    }
                } else {
                    return response()->json(['message' => "No Printer found."]);
                }
                return response()->json([
                    'response' => 201,
                    'message' => 'Store label print successfully.',
                    'count' => '',
                ], 201);
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
                'data' => 'No data Found!'
            ], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
