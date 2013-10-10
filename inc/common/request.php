<?php

(defined('main') || defined('admin')) or die ('no direct access');

class Request {
    private $query_parts;

    function Request() {
        $this->rest($_SERVER['QUERY_STRING']);
    }

    function rest($query) {
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
            $admin = defined('admin') ? 'admin/' : '';
            if ($pos == 0) {
                return array('Startpage', 'startpage/' . $admin . 'startpage');
            }
            if ($pos == 1) {
                $file = str_replace($parents[0] . '.', $parents[0] . '/' . $admin, implode('.', array($parents[0], $parents[0])));
            } else {
                $file = str_replace($parents[0] . '.', $parents[0] . '/' . $admin, implode('.', $parents));
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
                return array('Startpage', 'startpage/' . $admin . 'startpage');
            }
        } else {
            $parents[] = $param;
            return $this->find_module($pos + 1, $parents);
        }
    }

    function param_exists($pos) {
        if (is_integer($pos)) {
            return !empty($this->query_parts[$pos]);
        } else {
            return !empty($_POST[$pos]);
        }
    }

    function param($pos) {
        if (is_integer($pos)) {
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

    function is_post($name) {
        return $_SERVER['REQUEST_METHOD'] == 'POST'
            && session_status() == PHP_SESSION_ACTIVE
            && !empty($_SESSION['_csrf_token_' . $name])
            && $this->param('csrf_token') == $_SESSION['_csrf_token_' . $name];
    }

    function populate(array $fields) {
        foreach ($fields as $key => $value) {
            $fields[$key] = $_POST[$key];
        }
        return $fields;
    }

    public function forward($query, $message = null) {
        if (!is_null($message)) {
            $_SESSION['state_message'] = $message;
        }
        if (defined('admin')) {
            header('location: admin.php?' . $query);
        } else {
            header('location: index.php?' . $query);
        }
    }
}
