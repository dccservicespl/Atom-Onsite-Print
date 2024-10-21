<?php
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

function update_status($header_id = NULL)
{
    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . '/api/update_printer_status?header_id=' . $header_id,
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

function update_store_process_status($header_id = NULL, $store_id = NULL)
{
    try {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('API_URL') . '/api/update_store_process_status?header_id=' . $header_id . '&store_id=' . $store_id,
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
