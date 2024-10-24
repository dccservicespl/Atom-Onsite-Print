<?php
    function flashMessage(){
        $output = '';
        if (Session('error')) {
            $output .= '<div class="mb-1 mt-3">
                <div class="alert alert-danger border border-danger alert-dismissible fade show" role="alert">';
                $output .= session('error');
                    $output .= '<button type="button" class="btn-close text-danger" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>';
        }elseif(Session('success')){
            $output .= '<div class="mb-1 mt-3">
                <div class="alert alert-success border border-success alert-dismissible fade show" role="alert">';
                $output .= session('success');
                    $output .= '<button type="button" class="btn-close text-success" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>';
        }
        return $output;
    }
?>
