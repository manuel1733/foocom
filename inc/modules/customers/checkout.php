<?php

include 'inc/modules/customers/db.php';

class Customers_Checkout extends Controller {
    private $db;
    private $fields;

    function Customers_Checkout() {
        $this->db = new Customers_Database();
        $this->fields = array(
            'name' => '',
            'addition' => '',
            'street' => '',
            'zipcode' => '',
            'city' => '',
            'tel' => '',
            'fax' => '',
            'mail' => '',
            'country' => 1,
            'password1' => '',
            'password2' => ''
        );
    }

    function handle(Request $request) {
        if (empty($_SESSION['customer'])) {
            $this->login_or_request($request);
        } else {
            if ($request->is_post('customers-checkout')) {
                $fields = $request->populate(array('delivery' => '', 'payment' => '', 'comment' => '', 'conditions' => ''));
                if ($fields['conditions'] != 'read') {
                    $template = new Template('customers', 'checkout');
                    $template->set('message', 'Bitte die AGB\'s bestaetigen');
                    $template->display();
                } else {
                    unset($fields['conditions']);
                    $this->db->order_insert($fields, $_SESSION['customer-basket']);
                    $request->forward('customers-checkout-done');
                }
            } else {
                $template = new Template('customers', 'checkout');
                $template->display();
            }
        }
    }

    private function login_or_register(Request $request) {
        $template = new Template('customers', 'login.register');
        $message = null;
        if ($request->is_post('customers-login')) {
            $message = $this->login($request);
        }
        if ($request->is_post('customers-register')) {
            $message = $this->register($request);
        }

        if ($message == 0) {
            return;
        } else {
            $template->set('message', $message);
        }

        $template->set_ar('countries', $this->db->countries());
        $template->set_ar($this->fields);
        $template->display();
    }

    private function login(Request $request) {
        $fields = $request->populate(array ('mail' => '', 'password' => '' ));
        $fields['password'] = hash('sha512', $fields['password']);
        if ($this->db->login_is_valid($fields) == 1) {
            $fields = $this->db->get_by_mail($fields['mail']);
            $_SESSION['customer'] = $fields;
            $request->forward('customers-checkout');
            return 0;
        } else {
            return 'E-Mail konnte nicht gefunden werden, oder das Passwort stimmt nicht.';
        }
    }

    private function register(Request $request) {
        $fields = $request->populate($this->fields);
        $errors = $this->register_is_valid($fields);
        if (count($errors) == 0) {
            $fields['password'] = hash('sha512', $fields['password1']);
            unset($fields['password1']);
            unset($fields['password2']);
            $this->db->insert($fields);
            $request->forward('customers-checkout');
            return 0;
        } else {
            return 'Bitte ueberpruefen Sie die folgenden Fehler: ' . implode($errors);
        }
    }

    private function register_is_valid(array $fields) {
        $errors = array();
        if ($fields['password1'] != $fields['password2']) {
            $errors[] = 'Die Passwoerter stimmen nicht ueberein.';
        }
        if (empty($fields['mail'])) {
            $errors[] = 'Die E-Mail muss angegeben werden.';
        }
        return $errors;
    }
}
