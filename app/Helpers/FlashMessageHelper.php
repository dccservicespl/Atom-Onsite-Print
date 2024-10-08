<?php
    function flashMessage(){
        $output = '';
        if (Session('error')) {
            $output .= '<div class="alert alert-danger mt-4 mb-4" role="alert">'.
                             session('error')
                        .'</div>';
        }elseif(Session('success')){
            $output .= '<div class="alert alert-success mt-4 mb-4" role="alert">'.
                             session('success')
                        .'</div>';
        }
        return $output;
    }
?>
