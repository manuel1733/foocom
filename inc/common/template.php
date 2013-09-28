<?php

defined ('main') or die ('no direct access');

class Template {
    private $parts;
    private $keys;

    function Template($file) {
        $this->parts = array();
        $this->keys  = array();

        $content = file_get_contents('inc/modules/' . $file . '.html');
        $this->parts = explode('<!-- {SPLIT} -->', $content);
    }

    function set($k, $v) {
        $this->keys[$k] = htmlspecialchars($v, ENT_COMPAT | ENT_HTML401, 'UTF-8');
    }

    function set_ar(array $ar) {
        foreach ($ar as $k => $v) {
            $this->set($k, $v);
        }
    }

    function set_ar_out(array $ar, $pos) {
        $this->set_ar($ar);
        $this->out($pos);
    }

    function set_out($k, $v, $pos) {
        $this->set($k , $v);
        $this->out($pos);
    }

    function set_option_list($k, array $list) {
        $old_value = $this->keys[$k];
        $v = '';
        foreach ($list as $lk => $lv) {
            if ($old_value == $lk) {
                $v .= '<option value="' . $lk . '" selected="selected">' . $lv . '</option>';
            } else {
                $v .= '<option value="' . $lk . '">' . $lv . '</option>';
            }
        }
        $this->keys[$k] = $v;
    }

    private function get($pos) {
        $content = $this->parts[$pos];

        foreach ($this->keys as $k => $v) {
            $content = str_replace('{' . $k . '}' , $v , $content);
        }

        return $content;
    }

    function out($pos) {
        echo $this->get($pos);
    }
}
