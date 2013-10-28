<?php

class Employees_Logout extends Controller {
    public function handle(ORequest $request) {
        Change::log('logout');
        $_SESSION['auth'] = null;
        $request->forward('', 'successful logout');
    }
}
