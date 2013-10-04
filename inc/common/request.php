<?php

defined ('main') or die ('no direct access');

class Request {
    private $query_parts;

    function Request() {
        $query = $_SERVER['QUERY_STRING'];
        if (empty($query)) {
            $this->query_parts = array();
        } else {
            $this->query_parts = explode('-', preg_replace('/^([a-zA-Z0-9-]+).*/', '\1', $query));
        }
    }

    function get_module() {
        return $this->find_module(0, array());
    }

    private function find_module($pos, array $parents) {
        $param = $this->param($pos);

        if (empty($param) || is_numeric($param) || $pos > 5) {
            if ($pos == 0) {
                return array('Startpage', 'startpage/startpage');
            }
            if ($pos == 1) {
                $file = str_replace($parents[0] . '.', $parents[0] . '/', implode('.', array($parents[0], $parents[0])));
            } else {
                $file = str_replace($parents[0] . '.', $parents[0] . '/', implode('.', $parents));
            }
            if (file_exists('inc/modules/' . $file . '.php')) {
                $classname = array_reduce($parents, function ($o, $s) {
                    if ($o == null) {
                        return ucfirst($s);
                    } else {
                        return $o . '_' . ucfirst($s);
                    }
                });
                return array($classname, $file);
            } else {
                return array('Startpage', 'startpage/startpage');
            }
        } else {
            $parents[] = $param;
            return $this->find_module($pos + 1, $parents);
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
