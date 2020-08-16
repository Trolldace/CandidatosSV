<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/habilidad.php';
try {
    $habilidad = new Habilidad;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($habilidad->setIdCandidato($_POST['id_candidato'])) {
                    if ($habilidad->setHabilidad($_POST['habilidad'])) {
                        if ($habilidad->setDetalleHabilidad($_POST['detalle_habilidad'])) {
                            if ($habilidad->setExperienciaHabilidad($_POST['experiencia_habilidad'])) {
                                if ($habilidad->setLogros($_POST['logros'])) {
                                    if ($habilidad->create()) {
                                        echo json_encode(true);
                                    } else {
                                        throw new Exception(Database::getException());
                                    }
                                }
                            }
                        }
                    }
                }
                break;
            case 'update':
                if ($habilidad->setIdHabilidad($_POST['id_habilidad'])) {
                    if ($habilidad->setHabilidad($_POST['habilidad'])) {
                        if ($habilidad->setDetalleHabilidad($_POST['detalle_habilidad'])) {
                            if ($habilidad->setExperienciaHabilidad($_POST['experiencia_habilidad'])) {
                                if ($habilidad->setLogros($_POST['logros'])) {
                                    if ($habilidad->update()) {
                                        echo json_encode(true);
                                    } else {
                                        throw new Exception(Database::getException());
                                    }
                                }
                            }
                        }
                    }
                } else {
                    throw new Exception('No se ha encontrado la formacion academica del candidato');
                }
                break;
            case 'delete':
                if ($habilidad->setIdHabilidad($_POST['id_habilidad'])) {
                    if ($habilidad->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar la habilidad del candidato');
                    }
                } else {
                    throw new Exception('No se ha encontrado la habilidad del candidato');
                }
                break;
            case 'all':
                if ($habilidad->setIdCandidato($_POST['id_candidato'])) {
                    $data = $habilidad->all();
                }
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($habilidad->setIdHabilidad($_POST['id_habilidad'])) {
                    $data = $habilidad->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
