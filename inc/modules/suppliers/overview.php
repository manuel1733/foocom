<?php

$template = new Template('suppliers/overview');
$template->set_ar('suppliers', $sdb->all());
$template->out($design);
