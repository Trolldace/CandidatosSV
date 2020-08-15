<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/red.php';
try {
    $red = new Red;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($red->setRed($_POST['red'])) {
                    if ($red->create()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception("No se pudo crear la red social");
                    }
                } else {
                    throw new Exception("Verifique la red social");
                }
                break;
            case 'update':
                if ($red->setIdRed($_POST['id_red'])) {
                    if ($red->setRed($_POST['red'])) {
                        if ($red->create()) {
                            echo json_encode(true);
                        } else {
                            throw new Exception("No se pudo modificar la red social");
                        }
                    } else {
                        throw new Exception("Verifique la red social");
                    }
                } else {
                    throw new Exception('No se ha encontrado la red social');
                }
                break;
            case 'delete':
                if ($red->setIdRed($_POST['id_red'])) {
                    if ($red->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar la red social');
                    }
                } else {
                    throw new Exception('No se ha encontrado la red social');
                }
                break;
            case 'all':
                $data = $red->all();
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($red->setIdRed($_POST['id_red'])) {
                    $data = $red->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
?>