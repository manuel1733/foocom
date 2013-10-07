<?php

class Startpage extends Controller {
    function handle(Request $request) {
        $template = new Template('startpage', 'startpage');
        $template->set('name', 'du');
        $template->display();
    }
}
