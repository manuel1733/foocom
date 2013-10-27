<?php
/**
 * @author manuel
 *
 * with this file it is possible to load (easy) laravel migration files.
 * without laravel framework ... apart from this fact has nothing to do with laravel.
 */

include '../vendor/autoload.php';
include '../inc/config.php';

class Blueprint {
    private $sql;
    private $name;

    public function Blueprint($name) {
        $this->name = $name;
        $this->sql = array();
    }

    public function increments($column_name) {
        $this->sql[] = "\t$column_name int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY";
    }

    public function integer($column_name) {
        $this->sql[] = "\t$column_name int NOT NULL";
        return $this;
    }

    public function unsigned() {
        $i = count($this->sql) - 1;
        $this->sql[$i] = str_replace(" NOT NULL", " UNSIGNED NOT NULL", $this->sql[$i]);
    }

    public function string($column_name) {
        $this->sql[] = "\t$column_name varchar(255) NOT NULL";
    }

    public function text($column_name) {
        $this->sql[] = "\t$column_name text NOT NULL";
    }

    public function timestamp($column_name) {
        $this->sql[] = "\t$column_name timestamp NOT NULL";
    }

    public function dateTime($column_name) {
        $this->sql[] = "\t$column_name datetime NOT NULL";
    }

    public function date($column_name) {
        $this->sql[] = "\t$column_name date NOT NULL";
    }


    public function primary(array $columns) {
        $this->sql[] = "\tPRIMARY KEY($columns[0], $columns[1])";
    }

    public function foreign($column_name) {
        $this->sql[] = array($column_name);
        return $this;
    }

    public function references($ref_column) {
        $i = count($this->sql) - 1;
        $this->sql[$i][] = $ref_column;
        return $this;
    }

    public function on($ref_table) {
        $i = count($this->sql) - 1;
        $foreign = $this->sql[$i];
        $this->sql[$i] = "\tFOREIGN KEY ({$foreign[0]}) REFERENCES {$ref_table}({$foreign[1]})";
        return $this;
    }

    public function timestamps() {
        $this->timestamp('created_at');
        $this->timestamp('updated_at');
    }

    public function toSQL() {
        return "CREATE TABLE {$this->name} (\n" . implode(",\n", $this->sql) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8;\n\n";
    }
}

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
