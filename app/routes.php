<?php

/*
 |--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/', function()
{
    include '../inc/config.php';
    include '../inc/common/orequest.php';
    include '../inc/common/functions.php';
    include '../inc/common/database.php';
    include '../inc/common/template.php';
    include '../inc/common/controller.php';
    include '../inc/common/autoload.php';

    if (defined('main')) {
        include '../inc/design/main.php';
    } else {
        include '../inc/design/admin.php';
    }

    $request = new Request();

    if (defined('main')) {
        include '../inc/modules/customers/session.php';
    } else {
        include '../inc/modules/employees/admin/session.php';
    }

    $orequest = new ORequest();
    Template::$request = $orequest;

    $module = $orequest->get_module();

    $controller = new $module();
    $controller->handle($orequest);
});

