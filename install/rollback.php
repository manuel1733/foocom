<?php

echo '<html><head><title>Migration Rollback</title></head><pre>';

include 'common.php';

Schema::initialize();

$migrations = create_migrations();

krsort($migrations);

foreach($migrations as $migration) {
    require 'migrations/' . $migration['file'] . '.php';
    $mig_class = $migration['class'];
    $mig = new $mig_class();

    if (file_exists('migrations/' . $migration['file'] . '_seed.php')) {
        echo "rollback {$migration['file']} with seed\n";

        require 'migrations/' . $migration['file'] . '_seed.php';
        $seed_class = $migration['class'] . 'Seed';
        $seed = new $seed_class();

        $seed->down();
        $mig->down();

    } else {
        echo "rollback {$migration['file']} \n";
        $mig->down();

    }
}

echo "\n\n\nDone";
