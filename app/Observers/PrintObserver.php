<?php

namespace App\Observers;

use App\Helpers\ZplPrinterPrintHelper;
use App\Models\PrinterQueue;
use Illuminate\Support\Facades\Http;

class PrintObserver
{
    /**
     * Handle the PrinterQueue "created" event.
     */
    public function created(PrinterQueue $printerQueue): void {
        // dd($printerQueue);
        // $printer_queue_print = json_decode(print_observer($printerQueue->order_header_id, $printerQueue->print_file, $printerQueue->printer_ip_id, $printerQueue->page_no, $printerQueue->store_id), true);
        $printer_queue_print = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(env('API_URL').'/api/print_observer_api?header_id='.$printerQueue->order_header_id.'&print_file='.$printerQueue->print_file.'&printer_ip_id='.$printerQueue->printer_ip_id.'&page_no='.$printerQueue->page_no.'&store_id='.$printerQueue->store_id, [
            'user_id' => 'admindcc@yopmail.com',
            'password' => '12345678',
        ]);
        $print_data = json_decode($printer_queue_print, true)['data'];

        $printer_ip = $print_data['get_printer_details']['printer_ip'];
        $port = $print_data['get_printer_details']['port'];

        if ($print_data['print_file'] === "Store Number Label") {
            try {
                foreach($print_data['store_details'] as $value){
                    $zpl_message = "^XA
                                ^PW600
                                ^LL2400
                                ^FO0,120
                                ^A0R,550,600
                                ^FD{$value['store_code']}^FS
                                ^XZ";
                    $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);
                    $update_printer_status = PrinterQueue::find($printerQueue->id);
                    $update_printer_status->print_status = 1;
                    $update_printer_status->printer_response = "Labels printed successfully.";
                    $update_printer_status->save();
                    session()->flash('success', 'Labels printed successfully.');
                    $message = 'Store Number Label printed successfully.';
                }
            } catch (\Throwable $th) {
                $update_printer_response = PrinterQueue::find($printerQueue->id);
                $update_printer_response->printer_response = $th->getMessage();
                $update_printer_response->save();
                $message = 'Store Number Label printed response:'.$th->getMessage();
            }

        }elseif ($print_data['print_file'] === "Final Store Label") {
            try {
                $num_of_boxes = $print_data['num_of_boxes'];
                $store_name = $print_data['store_details']['store_name'];
                $order_header_inv_date = date('mdY', strtotime($print_data['order_header']['inv_date']));

                for ($i = 1; $i <= $num_of_boxes; $i++) {
                    $box_count = $i . "/" . $num_of_boxes;
                    $zpl_message = "^XA" .
                        "^PW600
                                    ^FO300,80
                                    ^A0R,300,300
                                    ^FD" . $store_name . "^FS
                                    ^FO10,80
                                    ^A0R,150,150
                                    ^FD" . $order_header_inv_date . "^FS
                                    ^FO10,900
                                    ^A0R,150,150
                                    ^FD" . $box_count . "^FS
                                    ^XZ";
                    $print_response = ZplPrinterPrintHelper::ZplPrintPrint($zpl_message, $printer_ip, $port);
                }
                session()->flash('success', 'Final Store Label printed successfully.');
                $message = 'Final Store Label printed successfully.';
                $update_printer_status = PrinterQueue::find($printerQueue->id);
                $update_printer_status->print_status = 1;
                $update_printer_status->printer_response = "Final Store Label printed successfully.";
                $update_printer_status->save();
            } catch (\Throwable $th) {
                $update_printer_response = PrinterQueue::find($printerQueue->id);
                $update_printer_response->printer_response = $th->getMessage();
                $update_printer_response->save();
                $message = 'Final Store Label printed response:'.$th->getMessage();
            }
        }
        $response = array(
            'response'=> 200,
            'message'=> $message
        );
        dd(json_encode($response));
    }

    /**
     * Handle the PrinterQueue "updated" event.
     */
    public function updated(PrinterQueue $printerQueue): void
    {
        //
    }

    /**
     * Handle the PrinterQueue "deleted" event.
     */
    public function deleted(PrinterQueue $printerQueue): void
    {
        //
    }

    /**
     * Handle the PrinterQueue "restored" event.
     */
    public function restored(PrinterQueue $printerQueue): void
    {
        //
    }

    /**
     * Handle the PrinterQueue "force deleted" event.
     */
    public function forceDeleted(PrinterQueue $printerQueue): void
    {
        //
    }
}
