<?php

if(!function_exists("my_dd")){

    function my_dd($data,$die = false){

        echo "<pre>";
        print_r($data);
        echo "</pre>";

        if ($die){
            die();
        }
    }

}
