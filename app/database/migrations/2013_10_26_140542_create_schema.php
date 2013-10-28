<?php

class CreateSchema extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergens', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('countries', function($table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('roles', function($table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('permissions', function($table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('role_permissions', function($table) {
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->primary(array('role_id', 'permission_id'));
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('permission_id')->references('id')->on('permissions');
        });

        Schema::create('employees', function($table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('role_id')->unsigned();
            $table->string('mail');
            $table->string('password');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::create('changes', function($table) {
            $table->dateTime('time');
            $table->integer('employee_id')->unsigned();
            $table->text('message');
            $table->foreign('employee_id')->references('id')->on('employees');
        });

        Schema::create('labels', function($table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('producers', function($table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('products', function($table) {
            $table->increments('id');
            $table->string('ean');
            $table->string('name');
            $table->text('description');
            $table->integer('min_stock');
            $table->integer('order_quantity');
            $table->string('food_value');
            $table->string('ingredients');
            $table->integer('producer_id')->unsigned();
            $table->foreign('producer_id')->references('id')->on('producers');
        });

        Schema::create('product_allergens', function($table) {
            $table->integer('product_id')->unsigned();
            $table->integer('allergen_id')->unsigned();
            $table->primary(array('product_id', 'allergen_id'));
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('allergen_id')->references('id')->on('allergens');
        });

        Schema::create('customer_groups', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('discount')->unsigned();
        });

        Schema::create('product_customer_groups', function($table) {
            $table->integer('product_id')->unsigned();
            $table->integer('customer_group_id')->unsigned();
            $table->integer('price');
            $table->integer('display');
            $table->primary(array('product_id', 'customer_group_id'));
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('customer_group_id')->references('id')->on('customer_groups');
        });

        Schema::create('product_groups', function($table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('name');
        });

        Schema::create('product_labels', function($table) {
            $table->integer('product_id')->unsigned();
            $table->integer('label_id')->unsigned();
            $table->primary(array('product_id', 'label_id'));
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('label_id')->references('id')->on('labels');
        });

        Schema::create('product_product_groups', function($table) {
            $table->integer('product_id')->unsigned();
            $table->integer('product_group_id')->unsigned();
            $table->primary(array('product_id', 'product_group_id'));
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_group_id')->references('id')->on('product_groups');
        });

        Schema::create('customers', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('addition');
            $table->string('street');
            $table->string('zipcode');
            $table->string('city');
            $table->integer('country_id')->unsigned();
            $table->integer('customer_group_id')->unsigned();
            $table->string('phone');
            $table->string('fax');
            $table->string('mail');
            $table->text('comment');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('customer_group_id')->references('id')->on('customer_groups');
        });

        Schema::create('customer_orders', function($table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('payment_method');
            $table->string('delivery_method');
            $table->text('comment');
            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::create('customer_order_products', function($table) {
            $table->integer('customer_order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('order_quantity')->unsigned();
            $table->integer('price')->unsigned();
            $table->text('comment');
            $table->primary(array('customer_order_id', 'product_id'));
            $table->foreign('customer_order_id')->references('id')->on('customer_orders');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('suppliers', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('addition');
            $table->string('street');
            $table->string('zipcode');
            $table->string('city');
            $table->string('country');
            $table->string('phone');
            $table->string('fax');
            $table->string('mail');
            $table->string('comment');
        });

        Schema::create('supplier_orders', function($table) {
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->integer('state');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('supplier_order_products', function($table) {
            $table->integer('supplier_order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('order_quantity')->unsigned();
            $table->integer('purchase_price')->unsigned();
            $table->primary(array('supplier_order_id', 'product_id'));
            $table->foreign('supplier_order_id')->references('id')->on('supplier_orders');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('product_suppliers', function($table) {
            $table->integer('product_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->string('product_number');
            $table->integer('purchase_price');
            $table->integer('order_quantity');
            $table->primary(array('product_id', 'supplier_id'));
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });

        Schema::create('batches', function($table) {
            $table->increments('id');
            $table->integer('supplier_order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->date('best_before');
            $table->integer('order_quantity')->unsigned();
            $table->integer('storage_quantity')->unsigned();
            $table->foreign('supplier_order_id')->references('id')->on('supplier_orders');
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('storages', function($table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('storage_yards', function($table) {
            $table->increments('id');
            $table->integer('storage_id')->unsigned();
            $table->string('number');
            $table->foreign('storage_id')->references('id')->on('storages');
        });

        Schema::create('storage_yard_batches', function($table) {
            $table->integer('storage_yard_id')->unsigned();
            $table->integer('batch_id')->unsigned();
            $table->primary(array('storage_yard_id', 'batch_id'));
            $table->foreign('storage_yard_id')->references('id')->on('storage_yards');
            $table->foreign('batch_id')->references('id')->on('batches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('changes');

        Schema::dropIfExists('employees');

        Schema::dropIfExists('role_permissions');

        Schema::dropIfExists('roles');

        Schema::dropIfExists('permissions');

        Schema::dropIfExists('product_allergens');

        Schema::dropIfExists('product_customer_groups');

        Schema::dropIfExists('customer_order_products');

        Schema::dropIfExists('customer_orders');

        Schema::dropIfExists('customers');

        Schema::dropIfExists('customer_groups');

        Schema::dropIfExists('product_product_groups');

        Schema::dropIfExists('product_groups');

        Schema::dropIfExists('product_labels');

        Schema::dropIfExists('product_suppliers');

        Schema::dropIfExists('supplier_order_products');

        Schema::dropIfExists('storage_yard_batches');

        Schema::dropIfExists('storage_yards');

        Schema::dropIfExists('batches');

        Schema::dropIfExists('supplier_orders');

        Schema::dropIfExists('suppliers');

        Schema::dropIfExists('storages');

        Schema::dropIfExists('allergens');

        Schema::dropIfExists('countries');

        Schema::dropIfExists('labels');

        Schema::dropIfExists('products');

        Schema::dropIfExists('producers');
    }
}
