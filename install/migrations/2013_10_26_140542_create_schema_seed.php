<?php

class CreateSchemaSeed extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::execute("INSERT INTO permissions (name) VALUES ('customers')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('customers/change')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('customers/create')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('customers/groups')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('customers/orders')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('employees')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('employees/roles')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('producers')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('products')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('products/allergens')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('products/change')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('products/groups')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('products/labels')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('storages')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/change')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/create')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/orders')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/orders/change')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/orders/close')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/orders/pdf')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/orders/receipt')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('vouchers')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('customers/orders')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('products/labels')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/orders/receipt')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('customers/orders')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('products/labels')");
        Schema::execute("INSERT INTO permissions (name) VALUES ('suppliers/orders/receipt')");

        Schema::execute("INSERT INTO roles (name) VALUES ('Admin')");

        Schema::execute("INSERT INTO role_permissions (role_id, permission_id) SELECT r.id, p.id FROM roles r, permissions p");

        Schema::execute("INSERT INTO employees (mail, password, role_id) VALUES ('admin@test.de', '" . hash('sha512', 'test') . "', 1)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
