<?php

class Employees extends Controller {
    private $fields;

    function Employees() {
        $this->fields = array (
            'first_name' => '',
            'last_name' => '',
            'mail' => '',
            'role_id' => 'Assistent',
        );
    }

    function handle(ORequest $request) {
        if ($request->is_post('employees')) {
            $this->handle_formular_submit($request);
        } else {
            $employee_id = $request->param(1);
            $template = new Template('employees', 'employees');
            if ($employee_id == 0) {
                $template->set('id', 0);
                $template->set_ar($this->fields);
            } else {
                $template->set_ar(Employee::find($employee_id)->toArray());
            }
            $template->set('employees', Employee::with('role')->get()->toArray());
            $template->set('roles', Role::all()->toArray());
            $template->display();
        }
    }

    private function handle_formular_submit(ORequest $request) {
        $id = $request->param(1);

        $employee = null;
        $fields = $request->populate($this->fields);

        if ($id == 0) {
            $password = uniqid();
            $employee = Employee::create($fields);
            $employee->password = hash('sha512', $password);
            $employee->save();
            $request->forward('employees', 'Mitarbeiter erfolgreich erstellt mit Password: ' . $password);
        } else {
            Employee::find($id)->update($fields);
            $request->forward('employees', 'Mitarbeiter erfolgreich geaendert.');
        }
    }
}
