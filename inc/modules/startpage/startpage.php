<?php

class Startpage extends Controller {
    function handle(ORequest $request) {
        $template = new Template('startpage', 'startpage');
        $template->set('name', 'du');
        $template->display();
    }
}
