<?php

if(!function_exists("mydd")){

    function mydd($data,$die = false){

        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if ($die == true){
            die();
        }
    }

}
