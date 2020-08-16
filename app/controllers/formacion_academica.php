<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/formacion_academica.php';
try {
    $formacion_academica = new FormacionAcademica;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($formacion_academica->setIdCandidato($_POST['id_candidato'])) {
                    if ($formacion_academica->setIdTitulo($_POST['id_titulo'])) {
                        if ($formacion_academica->setTitulo($_POST['titulo'])) {
                            if ($formacion_academica->setDescripcion($_POST['descripcion'])) {
                                if ($formacion_academica->create()) {
                                    echo json_encode(true);
                                } else {
                                    throw new Exception(Database::getException());
                                }
                            }
                        }
                    }
                }
                break;
            case 'update':
                if ($formacion_academica->setIdFormacionAcademica($_POST['id_formacion_academica'])) {
                    if ($formacion_academica->setIdTitulo($_POST['id_titulo'])) {
                        if ($formacion_academica->setTitulo($_POST['titulo'])) {
                            if ($formacion_academica->setDescripcion($_POST['descripcion'])) {
                                if ($formacion_academica->update()) {
                                    echo json_encode(true);
                                } else {
                                    throw new Exception(Database::getException());
                                }
                            }
                        }
                    }
                } else {
                    throw new Exception('No se ha encontrado la formacion academica del candidato');
                }
                break;
            case 'delete':
                if ($formacion_academica->setIdFormacionAcademica($_POST['id_formacion_academica'])) {
                    if ($formacion_academica->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar la formacion academica del candidato');
                    }
                } else {
                    throw new Exception('No se ha encontrado la formacion academica del candidato');
                }
                break;
            case 'all':
                if ($formacion_academica->setIdCandidato($_POST['id_candidato'])) {
                    $data = $formacion_academica->all();
                }
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($formacion_academica->setIdFormacionAcademica($_POST['id_formacion_academica'])) {
                    $data = $formacion_academica->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
