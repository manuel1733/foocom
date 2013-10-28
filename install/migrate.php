<?php

echo '<html><head><title>Migration Install</title></head><pre>';

include 'common.php';

Schema::initialize();

$migrations = create_migrations();

ksort($migrations);

foreach($migrations as $migration) {
    require 'migrations/' . $migration['file'] . '.php';
    $mig_class = $migration['class'];
    $mig = new $mig_class();

    if (file_exists('migrations/' . $migration['file'] . '_seed.php')) {
        echo "process {$migration['file']} with seed\n";

        require 'migrations/' . $migration['file'] . '_seed.php';
        $seed_class = $migration['class'] . 'Seed';
        $seed = new $seed_class();

        $mig->up();
        $seed->up();

    } else {
        echo "process {$migration['file']} \n";
        $mig->up();

    }
}

echo "\n\n\nDone";
