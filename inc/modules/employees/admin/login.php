<?php

class Employees_Login extends Controller {
    private $db;

    function Employees_Login() {
        $this->db = new Employees_Database();
    }


    public function handle(Request $request) {
        if ($request->is_post('employees-login')) {
            $this->handle_formular_submit($request);
        } else {
            $template = new Template('employees', 'login');
            $template->display();
        }
    }

    private function handle_formular_submit(Request $request) {
        $fields = $request->populate(array ('mail' => '', 'password' => '' ));
        $fields['password'] = hash('sha512', $fields['password']);
        if ($this->db->is_valid($fields) == 1) {
            $fields = $this->db->get_by_mail($fields['mail']);
            $_SESSION['auth'] = $fields;
            $request->forward('', 'successful login');
        } else {
            $request->forward('', 'please verify your mail and password.');
        }
    }
}
