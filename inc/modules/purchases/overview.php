<?php


$template = new Template('purchases/overview');
$template->set_ar('suppliers', $pdb->suppliers());
$template->out($design);

