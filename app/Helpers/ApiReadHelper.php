<?php

use Illuminate\Support\Facades\Log;

function generate_user_id_password()
{
    $user_id = env('API_USER_ID');
    $password = env('API_USER_PASSWORD');

    $postData = json_encode([
        'user_id' => $user_id,
        'password' => $password
    ]);
    return $postData;
}

function printer_queues_data($rec_date_time = NULL, $print_by_id = NULL, $print_status = NULL)
{
    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . '/api/printer_queues_data?rec_date_time=' . $rec_date_time . '&print_by_id=' . $print_by_id . '&print_status=' . $print_status,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => generate_user_id_password(),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}

function get_users($user_id = NULL)
{
    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . '/api/get_all_users?user_id=' . $user_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => generate_user_id_password(),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}

function printer_list()
{
    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . '/api/printer_list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => generate_user_id_password(),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}

function store_number_print_content($header_id = null)
{
    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . '/api/store_number_print_content?header_id=' . $header_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => generate_user_id_password(),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}

function final_store_label_print_content($header_id = null, $store_id = null, $num_of_boxes = null)
{
    // try {
    //     $url = env('API_URL') . '/api/final_store_label_print_content?get_inv_date=' . $get_inv_date . '&store_name=' . $store_name . '&num_of_boxes=' . $num_of_boxes;

    //     $curl = curl_init();
    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => $url,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => generate_user_id_password(),
    //         CURLOPT_HTTPHEADER => [
    //             'Content-Type: application/json'
    //         ],
    //     ]);

    //     $response = curl_exec($curl);

    //     if ($response === false) {
    //         Log::error('Curl error: ' . curl_error($curl));
    //         return ['error' => 'Curl error: ' . curl_error($curl)];
    //     }

    //     $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    //     Log::error('HTTP response code: ' . $httpCode);

    //     curl_close($curl);
    //     $decodedResponse = json_decode($response, true);

    //     if (isset($decodedResponse['success'])) {
    //         return $decodedResponse['success'];
    //     } elseif (isset($decodedResponse['error'])) {
    //         return $decodedResponse['error'];
    //     } else {
    //         return $decodedResponse;
    //     }
    // } catch (\Throwable $th) {
    //     Log::error('API Call error: ' . $th->getMessage());
    //     return null;
    // }

    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . '/api/final_store_label_print_content?header_id=' . $header_id . '&store_id=' . $store_id . '&num_of_boxes=' . $num_of_boxes,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => generate_user_id_password(),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}

function printer_status_update($printer_queues_id = null){
    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . '/api/printer_status_update?printer_queues_id=' . $printer_queues_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => generate_user_id_password(),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
}
