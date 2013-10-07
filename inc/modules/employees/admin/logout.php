<?php

class Employees_Logout extends Controller {
    public function handle(Request $request) {
        $_SESSION['auth'] = null;
        $request->forward('', 'successful logout');
    }
}
