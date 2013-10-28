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

    define('admin' , true);

    include '../inc/config.php';
    include '../inc/common/orequest.php';
    include '../inc/common/functions.php';
    include '../inc/common/database.php';
    include '../inc/common/template.php';
    include '../inc/common/controller.php';
    include '../inc/common/autoload.php';
    include '../inc/design/admin.php';

    $orequest = new ORequest();
    Template::$request = $orequest;

    include '../inc/modules/employees/admin/session.php';

    $module = $orequest->get_module();

    $controller = new $module();
    $controller->handle($orequest);
});

Route::get('/admin', function() {

    define('admin' , true);

    include '../inc/config.php';
    include '../inc/common/orequest.php';
    include '../inc/common/functions.php';
    include '../inc/common/database.php';
    include '../inc/common/template.php';
    include '../inc/common/controller.php';
    include '../inc/common/autoload.php';
    include '../inc/design/admin.php';

    $orequest = new ORequest();
    Template::$request = $orequest;

    include '../inc/modules/employees/admin/session.php';

    $module = $orequest->get_module();

    $controller = new $module();
    $controller->handle($orequest);
});
