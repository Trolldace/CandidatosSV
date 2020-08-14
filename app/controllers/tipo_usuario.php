<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/tipo_usuario.php';
try {
    $tp = new TipoUsuario;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'todo':
                $data = $tp->obtenerTipoUsuario();
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
