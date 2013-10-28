<?php
/**
 * @author manuel
 *
 * with this file it is possible to load (easy) laravel migration files.
 * without laravel framework ... apart from this fact has nothing to do with laravel.
 */

include '../vendor/autoload.php';
include '../inc/config.php';

class Schema {
    private static $db = false;

    static function initialize() {
        if (!self::$db) {
            self::$db = new PDO('mysql:host=localhost;dbname=' . DBDATE, DBUSER, DBPASS);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    static function create($name, Closure $f) {
        $table = new Blueprint($name);

        $f->__invoke($table);

        $sql = $table->toSQL();
        echo $sql . "\n\n";
        self::$db->exec($sql);
    }

    static function execute($raw_sql) {
        echo $raw_sql . "\n\n";
        self::$db->exec($raw_sql);
    }

    static function dropIfExists($name) {
        self::$db->exec("DROP TABLE IF EXISTS $name");
    }
}

class Migration {

}

function create_class_name($c, $w) {
    if ($c == null) {
        $c = ucfirst($w);
    } else {
        $c .= ucfirst($w);
    }
    return $c;
}

function create_migrations() {
    $migrations = array();

    if ($handle = opendir('./migrations')) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && substr($file, strlen($file) - 8) != 'seed.php') {
                $p = explode('_', substr($file, 18, strlen($file) - 22));
                $t = substr($file, 0, 17);
                $migrations[$t] = array(
                    'class' => array_reduce($p, 'create_class_name'),
                    'file' => substr($file, 0, -4)
                );
            }
        }
        closedir($handle);
    }

    return $migrations;
}
