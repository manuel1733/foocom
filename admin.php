<?php

error_reporting(E_ALL | E_STRICT);

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

define('admin' , true);

include 'vendor/autoload.php';

include 'inc/config.php';
include 'inc/common/request.php';
include 'inc/common/functions.php';
include 'inc/common/database.php';
include 'inc/common/template.php';
include 'inc/common/controller.php';
include 'inc/common/autoload.php';
include 'inc/design/admin.php';

$request = new Request();

include 'inc/modules/employees/admin/session.php';

$module = $request->get_module();

$controller = new $module();
$controller->handle($request);
