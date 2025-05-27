<?php

function dd($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);