<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/propuesta.php';
try {
    $propuesta = new Propuesta;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($propuesta->setIdCandidato($_POST['id_candidato'])) {
                    if ($propuesta->setpropuesta($_POST['propuesta'])) {
                        if ($propuesta->setDescripcion($_POST['descripcion'])) {
                            if ($propuesta->create()) {
                                echo json_encode(true);
                            } else {
                                throw new Exception(Database::getException());
                            }
                        }
                    }
                }
                break;
            case 'update':
                if ($propuesta->setIdPropuesta($_POST['id_propuesta'])) {
                    if ($propuesta->setpropuesta($_POST['propuesta'])) {
                        if ($propuesta->setDescripcion($_POST['descripcion'])) {
                            if ($propuesta->update()) {
                                echo json_encode(true);
                            } else {
                                throw new Exception(Database::getException());
                            }
                        }
                    }
                } else {
                    throw new Exception('No se ha encontrado la formacion academica del candidato');
                }
                break;
            case 'delete':
                if ($propuesta->setIdPropuesta($_POST['id_propuesta'])) {
                    if ($propuesta->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar la propuesta del candidato');
                    }
                } else {
                    throw new Exception('No se ha encontrado la propuesta del candidato');
                }
                break;
            case 'all':
                if ($propuesta->setIdCandidato($_POST['id_candidato'])) {
                    $data = $propuesta->all();
                }
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($propuesta->setIdPropuesta($_POST['id_propuesta'])) {
                    $data = $propuesta->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
