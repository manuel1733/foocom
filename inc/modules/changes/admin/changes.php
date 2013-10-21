<?php

class Changes extends Controller {
    private $db;
    private $fields;

    function Changes() {
        $this->db = new Changes_Database();
    }

    function handle(Request $request) {
        $template = new Template('changes', 'changes');
        $template->set('changes', $this->db->last());
        $template->display();
    }
}
