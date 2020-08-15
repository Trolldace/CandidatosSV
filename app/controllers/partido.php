<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/partido.php';
try {
    $partido = new Partido;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($partido->setPartido($_POST['partido'])) {
                    if ($partido->setLogo($_FILES['logo'])) {
                        if ($partido->create()) {
                            echo json_encode(true);
                        } else {
                            throw new Exception("No se pudo crear el partido politico");
                        }
                    } else {
                        throw new Exception('Verifique la imagen ingresada');
                    }
                } else {
                    throw new Exception("Verifique el partido politico");
                }
                break;
            case 'update':
                if ($partido->setIdPartido($_POST['id_partido'])) {
                    if ($partido->setPartido($_POST['partido'])) {
                        if ($partido->setLogo($_FILES['logo'])) {
                            if ($partido->update()) {
                                echo json_encode(true);
                            } else {
                                throw new Exception("No se pudo modificar el partido politico");
                            }
                        } else {
                            throw new Exception('Verifique la imagen ingresada');
                        }
                    } else {
                        throw new Exception("Verifique el partido politico");
                    }
                } else {
                    throw new Exception('No se ha encontrado el partido politico');
                }
                break;
            case 'delete':
                if ($partido->setIdPartido($_POST['id_partido'])) {
                    if ($partido->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar el partido politico');
                    }
                } else {
                    throw new Exception('No se ha encontrado el partido politico');
                }
                break;
            case 'all':
                $data = $partido->all();
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($partido->setIdPartido($_POST['id_partido'])) {
                    $data = $partido->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
