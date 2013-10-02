<?php

defined ('main') or die ('no direct access');

class Request {
    private $query_parts;

    function Request() {
        $query = $_SERVER['QUERY_STRING'];
        if (empty($query)) {
            $this->query_parts = array();
        } else {
            $this->query_parts = explode('-', preg_replace('/^([a-zA-Z0-9-_]+).*/', '\1', $query));
        }
    }

    function get_module() {
        if ($this->param_exists(0) && file_exists('inc/modules/' . $this->param(0) . '/' . $this->param(0) . '.php')) {
            return $this->param(0);
        } else {
            return 'startpage';
        }
    }

    function param_exists($pos) {
        if (is_numeric($pos)) {
            return !empty($this->query_parts[$pos]);
        } else {
            return !empty($_POST[$pos]);
        }
    }

    function param($pos) {
        if (is_numeric($pos)) {
            if ($this->param_exists($pos)) {
                return $this->query_parts[$pos];
            } else {
                return '';
            }
        } else {
            if ($this->param_exists($pos)) {
                return $_POST[$pos];
            } else {
                return null;
            }
        }
    }

    function param_as_number($pos) {
        return preg_replace('/\D/', '', $this->param($pos));
    }

    function is_post() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function populate(array $fields) {
        foreach ($fields as $key => $value) {
            $fields[$key] = $_POST[$key];
        }
        return $fields;
    }
}
