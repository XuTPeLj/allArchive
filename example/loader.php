<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);


spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    include_once(__DIR__ . '/../' . $class_name . '.php');
});

