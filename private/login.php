<?php
//variables de diseño
$bg = "bg-admin";
require_once('../config/app.php');
require_once(APP_PATH . '/views/private/template/head.view.php');
if (!isset($_SESSION['id_usuario'])) {
    require_once(APP_PATH . '/views/private/login/index.view.php');
} else {
    header('location: ../admin/dashboard');
}
require_once(APP_PATH . '/views/private/template/footer.view.php');
