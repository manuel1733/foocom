<?php

include 'inc/modules/employees/admin/db.php';

class Employees extends Controller {
    private $db;
    private $fields;

    function Employees() {
        $this->db = new Employees_Database();
        $this->fields = array (
            'name' => '',
            'mail' => '',
        );
    }

    function handle(Request $request) {
        if ($request->is_post('employees')) {
            $this->handle_formular_submit($request);
        } else {
            $employee_id = $request->param(1);
            $template = new Template('employees', 'employees');
            if ($employee_id == 0) {
                $template->set('id', 0);
                $template->set_ar($this->fields);
            } else {
                $template->set_ar($this->db->get($employee_id));
            }
            $template->set_ar('employees', $this->db->all());
            $template->display();
        }
    }

    private function handle_formular_submit(Request $request) {
        $employee_id = $request->param(1);
        if ($employee_id == 0) {
            $password = uniqid();
            $fields = $request->populate($this->fields);
            $fields['password'] = hash('sha512', $password);
            $this->db->insert($fields);
            $request->forward('employees', 'Mitarbeiter erfolgreich erstellt mit Password: ' . $password);
        } else {
            $fields = $request->populate($this->fields);
            $fields['employee_id'] = $employee_id;
            $this->db->update($fields);
            $request->forward('employees', 'Mitarbeiter erfolgreich geaendert.');
        }
    }
}
