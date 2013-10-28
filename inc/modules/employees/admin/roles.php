<?php

class Employees_Roles extends Controller {
    private $db;

    function Employees_Roles() {
        $this->db = new Employees_Database();
    }

    function handle(ORequest $request) {
        if ($request->is_post('employees-roles')) {
            $r = $request->param('r');
            foreach ($this->db->roles_all_paths() as $a) {
                if (empty($a['checked']) && !empty($r[$a['path']][$a['role']])) {
                    $this->db->roles_insert($a['path'], $a['role']);
                }

                if (!empty($a['checked']) && empty($r[$a['path']][$a['role']])) {
                    $this->db->roles_delete($a['path'], $a['role']);
                }
            }
            $request->forward('employees-roles');
        } else {
            $tpl = new Template('employees', 'roles');
            $tpl->set('roles', $this->db->roles_all());
            $tpl->set('paths', $this->db->roles_all_paths());
            $tpl->display();
        }
    }
}

/**

INSERT INTO employee_roles VALUES('Admin', 'suppliers/orders/change');
INSERT INTO employee_roles VALUES('Admin', 'suppliers/orders/close');
INSERT INTO employee_roles VALUES('Admin', 'suppliers');
INSERT INTO employee_roles VALUES('Admin', 'suppliers/change');
INSERT INTO employee_roles VALUES('Admin', 'suppliers/create');
INSERT INTO employee_roles VALUES('Admin', 'suppliers/orders/receipt');
INSERT INTO employee_roles VALUES('Admin', 'suppliers/orders');
INSERT INTO employee_roles VALUES('Admin', 'suppliers/orders/pdf');
INSERT INTO employee_roles VALUES('Admin', 'storages');
INSERT INTO employee_roles VALUES('Admin', 'vouchers');
INSERT INTO employee_roles VALUES('Admin', 'customers/groups');
INSERT INTO employee_roles VALUES('Admin', 'customers');
INSERT INTO employee_roles VALUES('Admin', 'customers/change');
INSERT INTO employee_roles VALUES('Admin', 'customers/create');
INSERT INTO employee_roles VALUES('Admin', 'customers/orders');
INSERT INTO employee_roles VALUES('Admin', 'employees');
INSERT INTO employee_roles VALUES('Admin', 'employees/roles');
INSERT INTO employee_roles VALUES('Admin', 'products/groups');
INSERT INTO employee_roles VALUES('Admin', 'products/allergens');
INSERT INTO employee_roles VALUES('Admin', 'products/change');
INSERT INTO employee_roles VALUES('Admin', 'products/labels');
INSERT INTO employee_roles VALUES('Admin', 'products');
INSERT INTO employee_roles VALUES('Admin', 'producers');


*/
