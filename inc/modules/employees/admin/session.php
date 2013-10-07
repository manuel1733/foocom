<?php

session_start();

if (empty($_SESSION['auth'])) {
    $request->rest('employees-login');
}
