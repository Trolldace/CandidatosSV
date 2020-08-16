<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/experiencia.php';
try {
    $experiencia = new Experiencia;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($experiencia->setIdCandidato($_POST['id_candidato'])) {
                    if ($experiencia->setDesde($_POST['desde'])) {
                        if ($experiencia->setHasta($_POST['hasta'])) {
                            if ($experiencia->setInstitucion($_POST['institucion'])) {
                                if ($experiencia->setCargo($_POST['cargo'])) {
                                    if ($experiencia->setFuncion($_POST['funcion'])) {
                                        if ($experiencia->create()) {
                                            echo json_encode(true);
                                        } else {
                                            throw new Exception(Database::getException());
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                break;
            case 'update':
                if ($experiencia->setIdExperiencia($_POST['id_experiencia'])) {
                    if ($experiencia->setDesde($_POST['desde'])) {
                        if ($experiencia->setHasta($_POST['hasta'])) {
                            if ($experiencia->setInstitucion($_POST['institucion'])) {
                                if ($experiencia->setCargo($_POST['cargo'])) {
                                    if ($experiencia->setFuncion($_POST['funcion'])) {
                                        if ($experiencia->update()) {
                                            echo json_encode(true);
                                        } else {
                                            throw new Exception(Database::getException());
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    throw new Exception('No se ha encontrado la experiencia del candidato');
                }
                break;
            case 'delete':
                if ($experiencia->setIdExperiencia($_POST['id_experiencia'])) {
                    if ($experiencia->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar la experiencia del candidato');
                    }
                } else {
                    throw new Exception('No se ha encontrado la experiencia del candidato');
                }
                break;
            case 'all':
                if ($experiencia->setIdCandidato($_POST['id_candidato'])) {
                    $data = $experiencia->all();
                }
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($experiencia->setIdExperiencia($_POST['id_experiencia'])) {
                    $data = $experiencia->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
