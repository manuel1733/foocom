<?php

use Illuminate\Database\Capsule\Manager as Capsule;

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBDATE', 'foocom');

// Make a new connection
$capsule = new Capsule;

$capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => DBHOST,
    'port'      => 3306,
    'database'  => DBDATE,
    'username'  => DBUSER,
    'password'  => DBPASS,
    'prefix'    => '',
    'charset'   => "utf8",
    'collation' => "utf8_unicode_ci",
));

$capsule->bootEloquent();

$capsule->setAsGlobal();
