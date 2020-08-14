<?php
//Definiendo rutas de carpetas constantes
//Ruta de carpeta app
define('APP_PATH', __DIR__ . '/..');
//ruta de carpeta web
define('WEB_PATH', '../web/');
//ruta de carpeta de  imagenes
define('IMG_PATH', '../web/img/');
//Mandando a llamar el archivo database
require_once 'database.class.php';
//mandando a llamar el archivo validator
require_once 'validator.class.php';
