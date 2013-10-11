<?php

function Autoload($classname) {
    // echo $classname . '<br>';
    // var_dump(debug_backtrace());

    $ar = explode('_', strtolower($classname));


    $admin = defined('admin') ? 'admin/' : '';

    if (count($ar) == 1) {
        include 'inc/modules/' . $ar[0] . '/' . $admin . $ar[0] . '.php';
    } else {
        $str = implode('.', $ar);
        include 'inc/modules/' . $ar[0] . '/' . $admin . substr($str, strlen($ar[0]) + 1) . '.php';
    }
}

spl_autoload_register('Autoload');
