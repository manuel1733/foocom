<?php

defined('admin') or die ('no direct access');

class Producers extends Controller {
    function handle(ORequest $request) {
        $id = $request->param_as_number(1);

        if ($request->is_post('producers')) {
            $producer = null;
            if ($id == 0) {
                $producer = new Producer;
            } else {
                $producer = Producer::find($id);
            }
            $producer->name = $request->param('name');
            $producer->save();
            $request->forward('producers-' . $id);
        } else {
            $template = new Template('producers', 'producers');
            $template->set('id', $id);
            if (empty($id)) {
                $template->set_ar(array('name' => ''));
            } else {
                $template->set_ar(Producer::find($id)->toArray());
            }
            $template->set_ar('producers', Producer::all()->toArray());
            $template->display();
        }
    }
}
