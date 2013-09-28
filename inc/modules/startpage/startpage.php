<?php

defined('main') or die ('no direct access');


$design->header('Startseite von food commerce (foocom)');
$tpl = new Template('startpage/startpage');

$tpl->out(0);
$design->footer();

