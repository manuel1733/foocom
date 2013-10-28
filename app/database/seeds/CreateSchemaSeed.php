<?php

class CreateSchemaSeed extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::insert("INSERT INTO permissions (name) VALUES ('customers')");
        DB::insert("INSERT INTO permissions (name) VALUES ('customers/change')");
        DB::insert("INSERT INTO permissions (name) VALUES ('customers/create')");
        DB::insert("INSERT INTO permissions (name) VALUES ('customers/groups')");
        DB::insert("INSERT INTO permissions (name) VALUES ('customers/orders')");
        DB::insert("INSERT INTO permissions (name) VALUES ('employees')");
        DB::insert("INSERT INTO permissions (name) VALUES ('employees/roles')");
        DB::insert("INSERT INTO permissions (name) VALUES ('producers')");
        DB::insert("INSERT INTO permissions (name) VALUES ('products')");
        DB::insert("INSERT INTO permissions (name) VALUES ('products/allergens')");
        DB::insert("INSERT INTO permissions (name) VALUES ('products/change')");
        DB::insert("INSERT INTO permissions (name) VALUES ('products/groups')");
        DB::insert("INSERT INTO permissions (name) VALUES ('products/labels')");
        DB::insert("INSERT INTO permissions (name) VALUES ('storages')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/change')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/create')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/orders')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/orders/change')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/orders/close')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/orders/pdf')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/orders/receipt')");
        DB::insert("INSERT INTO permissions (name) VALUES ('vouchers')");
        DB::insert("INSERT INTO permissions (name) VALUES ('customers/orders')");
        DB::insert("INSERT INTO permissions (name) VALUES ('products/labels')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/orders/receipt')");
        DB::insert("INSERT INTO permissions (name) VALUES ('customers/orders')");
        DB::insert("INSERT INTO permissions (name) VALUES ('products/labels')");
        DB::insert("INSERT INTO permissions (name) VALUES ('suppliers/orders/receipt')");

        DB::insert("INSERT INTO roles (name) VALUES ('Admin')");

        DB::insert("INSERT INTO permission_role (role_id, permission_id) SELECT r.id, p.id FROM roles r, permissions p");

        DB::insert("INSERT INTO roles (name) VALUES ('Leiter')");
        DB::insert("INSERT INTO roles (name) VALUES ('Assistent')");

        DB::insert("INSERT INTO countries (name) VALUES ('Switzerland')");
        DB::insert("INSERT INTO countries (name) VALUES ('Austria')");
        DB::insert("INSERT INTO countries (name) VALUES ('Germany')");

        DB::insert("INSERT INTO customer_groups (name, discount) VALUES ('Kunden', 0)");
        DB::insert("INSERT INTO customer_groups (name, discount) VALUES ('Genossenschaftler', 10)");
        DB::insert("INSERT INTO customer_groups (name, discount) VALUES ('Freunde', 20)");

        DB::insert("INSERT INTO employees (mail, password, role_id) VALUES ('admin@test.de', '" . hash('sha512', 'test') . "', 1)");
        DB::insert("INSERT INTO customers (mail, password, country_id, customer_group_id) VALUES ('admin@test.de', '" . hash('sha512', 'test') . "', 1, 1)");
    }
}
