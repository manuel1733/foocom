<?php

(defined('main') || defined('admin')) or die ('no direct access');

class Template {
    private $file;
    private $keys;

    function Template($module, $file) {
        $admin = defined('admin') ? 'admin/' : '';
        $this->file = 'inc/modules/' . $module . '/' . $admin . $file . '.view.php';
        $this->keys  = array();
    }

    function set($k, $v) {
        if (is_array($k)) {
            $ar = $k;
            foreach($ar as $k => $v) {
                $this->set($k, $v);
            }
        } else if (is_array($v)) {
            $this->is_valid_key($k);
            $this->keys[$k] = $this->handle_special_chars($v);
        } else {
            $this->is_valid_key($k);
            $this->keys[$k] = htmlspecialchars($v, ENT_COMPAT, 'UTF-8');
        }
    }

    function set_ar($k, array $ar = null) {
        if ($ar == null && is_array($k)) {
            $ar = $k;
            foreach($ar as $k => $v) {
                $this->set($k, $v);
            }
        } else {
            $this->is_valid_key($k);
            $this->keys[$k] = $this->handle_special_chars($ar);
        }
    }

    private function handle_special_chars(array $ar) {
        foreach ($ar as $k => $v) {
            if (is_array($v)) {
                $ar[$k] = $this->handle_special_chars($v);
            } else {
                $this->is_valid_key($k);
                $ar[$k] = htmlspecialchars($v, ENT_COMPAT, 'UTF-8');
            }
        }
        return $ar;
    }

    private function is_valid_key($k) {
        if (!preg_match("/^[a-z][a-z0-9_]*$/", $k)) {
            throw new Exception('the key for a template should only contain lower case letters, numbers and underscore. It also must start with a letter.: ' . $k);
        }
    }

    private function is_box() {
        $sub = 'box.view.php';
        return substr($this->file, strlen($this->file), strlen($sub)) == $sub;
    }

    /**
     * output html. prepare the values and include the view file.
     *
     * @param Design $design the design is used by the view file. The view file will set the header and footer.
     *
     */
    function display() {
        if (!$this->is_box()) {
            global $request;
            $design = new Design($request);
        }

        extract($this->keys);

        include $this->file;
    }

    protected function out_options(array $rows, $selected = null) {
        foreach ($rows as $row) {
            $k = $row['id'];
            $v = $row['name'];
            if (empty($row['selected']) && (empty($selected) || $selected != $k)) {
                echo '<option value="' . $k . '">' . $v . '</option>';
            } else {
                echo '<option value="' . $k . '" selected="selected">' . $v . '</option>';
            }
        }
    }

    protected function out_checkbox($value) {
        if (empty($value)) {
            return ' ';
        } else {
            return ' checked="checked"';
        }
    }

    protected function insert_csrf_token($name) {
        $token = md5(mt_rand() . time() . $name);
        $_SESSION['_csrf_token_' . $name] = $token;
        echo '<input type="hidden" name="csrf_token" value="' . $token . '" />';
    }

    public static function clean_name($name) {
        $name = preg_replace('/\xc3\xbc/', 'ue', $name);
        return preg_replace('/[^a-zA-Z-0-9]/', '', $name);
    }
}
