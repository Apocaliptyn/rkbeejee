<?php

class View {

    function render($path, $data = []) {

        if (is_array($data))
            extract($data, EXTR_PREFIX_ALL, "viewdata");

        require(ROOT . '/app/views/' . $path . '.php');

    }
}