<?php

use App\Mail\BusinessRegistered;
use App\Models\PrinterQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

function send_otp_to_business_email($business_id = NULL){
    $get_business_details = DB::table('business')
                            ->where('id', $business_id)
                            ->first();
    $insert_business = [
        'business_otp' => rand(100000, 999999)
    ];
    $check_business_details = DB::table('business')
        ->where('id', $business_id)
        ->update($insert_business);
    Mail::to($get_business_details->business_email)->send(new BusinessRegistered($insert_business));
}

function insert_business($user_id = NULL){
    $insert_business = [
        'user_id' => $user_id,
        'category_id' => session()->get('business_setup')['business_details']['category_id'],
        'pricing_id' => session()->get('business_setup')['plan']['plan_id'],
        'business_name' => session()->get('business_setup')['business_details']['business_name'],
        'business_website' => session()->get('business_setup')['input_domain'],
        'wwd_url' => session()->get('business_setup')['domain'],
        'business_desc' => session()->get('business_setup')['business_details']['business_description'],
        'business_email' => session()->get('business_setup')['business_details']['business_email'] . '@' . session()->get('business_setup')['domain'],
        'business_status' => 'P',
        'business_otp' => rand(100000, 999999),
        'is_email_varified' => 0,
        'created_at' => now(),
    ];
   $insert_business_id = DB::table('business')->insertGetId($insert_business);
   session()->forget('reg_come_form');
   session()->forget('business_setup');
   return $insert_business_id;
}

function update_printer_ques($printerQueue_id = NULL, $status = NUll, $message = NULL){
    $update_printer_response = PrinterQueue::find($printerQueue_id);
    $update_printer_response->print_status = $status;
    $update_printer_response->printer_response = $message;
    $update_printer_response->save();
}

?>
