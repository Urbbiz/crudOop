<?php
session_start();
define('URL', 'http://localhost/php_projects/crudOop/'); // konstanta,
define('INSTALL_DIR', '/php_projects/crudOop/');
define('DIR', __DIR__.'/');
require DIR.'app/appleController.php';
require DIR.'app/Json.php';
require DIR.'app/Box.php';

_d($_SESSION, 'sesija ---->')
?>