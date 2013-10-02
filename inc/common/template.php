<?php

defined ('main') or die ('no direct access');

class Template {
    private $file;
    private $keys;

    function Template($file) {
        $this->file = 'inc/modules/' . $file . '.view.php';
        $this->keys  = array();
    }

    function set($k, $v) {
        $this->is_valid_key($k);
        $this->keys[$k] = htmlspecialchars($v, ENT_COMPAT | ENT_HTML401, 'UTF-8');
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
                $ar[$k] = htmlspecialchars($v, ENT_COMPAT | ENT_HTML401, 'UTF-8');
            }
        }
        return $ar;
    }

    private function is_valid_key($k) {
        if (!preg_match("/^[a-z][a-z0-9_]*$/", $k)) {
            throw new Exception('the key for a template should only contain lower case letters, numbers and underscore. It also must start with a letter.: ' . $k);
        }
    }

    function set_row_iterator($key, Database_Result $iterator) {
        $this->iterators[$key] = $iterator;
    }

    /**
     * output html. prepare the values and include the view file.
     *
     * @param Design $design the design is used by the view file. The view file will set the header and footer.
     *
     */
    function out(Design $design) {
        extract($this->keys);

        include $this->file;
    }

    function out_options(array $rows, $selected = null) {
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

    function out_checkbox($value) {
        if ($value == 0) {
            return '';
        } else {
            return ' checked="checked"';
        }
    }
}
