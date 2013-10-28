<?php

class Changes extends Controller {
    private $db;

    function Changes() {
        $this->db = new Changes_Database();
    }

    function handle(ORequest $request) {
        $template = new Template('changes', 'changes');
        $template->set('changes', $this->db->last());
        $template->display();
    }
}
