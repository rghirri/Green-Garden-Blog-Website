<?php

/**
 * Redirect to URL after form submit
 *
 * @param string $path Path to redirect to after form submit
 *
 * @return void
 */


function redirect($path){

    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
        $protocol = 'https';
    }else{
        $protocol = 'http';
    }

    header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $path);
    exit;

}