<?php
function autoload($className) {
    $filename = 'classes/' . $className . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register('autoload');
