<?php

    function generateStatusCode($status = NULL){
        $output = '';
        if ($status === 0) {
            $output .= '
                <span class="badge badge rounded-pill d-block p-2 badge-subtle-danger border border-danger">Pending</span>
            ';
        }elseif($status === 1){
            $output .= '
                <span class="badge badge rounded-pill d-block p-2 badge-subtle-success border border-success">Success
                </span>
            ';
        }else{
            $output .='
                <span class="badge badge rounded-pill d-block p-2 badge-subtle-secondary border border-secondary">On Hold
                </span>
            ';
        }

        return $output;
    }

    function get_day_name($day = NULL) {
        if ($day !== NULL && $day >= 1 && $day <= 7) {
            switch ($day) {
                case '1':
                    $day_name = 'Sunday';
                    break;
                case '2':
                    $day_name = 'Monday';
                    break;
                case '3':
                    $day_name = 'Tuesday';
                    break;
                case '4':
                    $day_name = 'Wednesday';
                    break;
                case '5':
                    $day_name = 'Thursday';
                    break;
                case '6':
                    $day_name = 'Friday';
                    break;
                case '7':
                    $day_name = 'Saturday';
                    break;
            }
        } else {
            $day_name = '';
        }

        return $day_name;
    }
?>
