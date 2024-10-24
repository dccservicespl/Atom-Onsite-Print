<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Helpers\ZplPrinter;
use Illuminate\Support\Facades\Log;
use Exception;

class ZplPrinterPrintHelper
{
    public static function ZplPrintPrint(string $zpl, $zpl_ip, $zpl_port)
    {
        // try {
            // $zpl = "";
            if (!empty($store_name)) {
                // $zpl = "^XA".
                //         "^FO50,50^A0N,150,150^FD".$store_name."^FS".
                //         "^FO50,300^A0N,100,100^FD".$get_inv_date."^FS".
                //         "^FO600,300^A0N,100,100^FD".$box_count."^FS
                //         ^XZ";
            }

            // $zpl_ip = env('ZBL_PRINTER_IP');
            // $zpl_port = env('ZBL_PRINTER_PORT');
            $zpl_message = trim($zpl);

            if (!empty($zpl_ip) && !empty($zpl)) {
                ZplPrinter::printer($zpl_ip, $zpl_port)->send($zpl_message);
            }
        // } catch (Exception $e) {
        //     Log::error("Printing error: " . $e->getMessage());
        //     throw $e;
        // }
    }
}
