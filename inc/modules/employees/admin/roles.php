<?php

class Employees_Roles extends Controller {
    function handle(ORequest $request) {
        if ($request->is_post('employees-roles')) {
            $r = $request->param('r');
            $roles = Role::all();
            foreach (Permission::with('roles')->get() as $perm) {
                foreach ($roles as $role) {
                    if ($role->id == 1) {
                        continue;
                    }
                    $roleInDB = false;
                    foreach ($perm->roles as $permRole) {
                        if ($permRole->id == $role->id) {
                            $roleInDB = true;
                        }
                    }
                    if (!empty($r[$perm->id][$role->id]) && !$roleInDB) {
                        $perm->roles()->attach($role->id);
                        Change::log('grant permission "' . $perm->name . '" to role "' . $role->name . '"');
                    }
                    if (empty($r[$perm->id][$role->id]) && $roleInDB) {
                        $perm->roles()->detach($role->id);
                        Change::log('revoke permission "' . $perm->name . '" from role "' . $role->name . '"');
                    }
                }
            }


            //             foreach ($this->db->roles_all_paths() as $a) {
            //                 if (empty($a['checked']) && !empty($r[$a['path']][$a['role']])) {
            //                     $this->db->roles_insert($a['path'], $a['role']);
            //                 }

            //                 if (!empty($a['checked']) && empty($r[$a['path']][$a['role']])) {
            //                     $this->db->roles_delete($a['path'], $a['role']);
            //                 }
            //             }
            $request->forward('employees-roles');
        } else {
            $tpl = new Template('employees', 'roles');
            $tpl->set('roles', Role::all()->toArray());
            $tpl->set('permissions', Permission::with('roles')->get()->toArray());
            $tpl->display();
        }
    }
}
