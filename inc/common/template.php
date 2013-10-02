<?php

defined ('main') or die ('no direct access');

class Template {
    private $file;
    private $keys;
    private $iterators;

    function Template($file) {
        $this->file = 'inc/modules/' . $file . '.view.php';
        $this->keys  = array();
        $this->iterators = array();
    }

    function set($k, $v) {
        if (!preg_match("/^[a-z][a-z0-9_]*$/", $k)) {
            throw new Exception('the key for a template should only contain lower case letters, numbers and underscore. It also must start with a letter.: ' . $k);
        }
        $this->keys[$k] = htmlspecialchars($v, ENT_COMPAT | ENT_HTML401, 'UTF-8');
    }

    function set_ar(array $ar) {
        foreach($ar as $k => $v) {
            $this->set($k, $v);
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

    function out_options($iterator_key) {
        foreach ($this->out_iterate($iterator_key) as $row) {
            $k = $row['id'];
            $v = $row['name'];
            if ($row['selected'] == null) {
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

    function out_iterate($iterator_key) {
        return new Template_Row_Iterator($this->iterators[$iterator_key]);
    }
}

class Template_Row_Iterator  implements Iterator {
    private $iterator;

    function Template_Row_Iterator(Database_Result $iterator) {
        $this->iterator = $iterator;
    }

    function rewind() {
        $this->iterator->rewind();
    }

    function current() {
        $row = $this->iterator->current();
        foreach ($row as $k => $v) {
            $row[$k] = htmlspecialchars($v, ENT_COMPAT | ENT_HTML401, 'UTF-8');
        }
        return $row;
    }

    function key() {
        return $this->iterator->key();
    }

    function next() {
        $this->iterator->next();
    }

    function valid() {
        return $this->iterator->valid();
    }
}
