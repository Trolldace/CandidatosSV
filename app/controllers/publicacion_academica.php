<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/publicacion_academica.php';
try {
    $publicacion_academica = new PublicacionAcademica;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($publicacion_academica->setIdCandidato($_POST['id_candidato'])) {
                    if ($publicacion_academica->setAnio($_POST['anio'])) {
                        if ($publicacion_academica->setTitulo($_POST['titulo'])) {
                            if ($publicacion_academica->setDescripcion($_POST['descripcion'])) {
                                if ($publicacion_academica->create()) {
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
                if ($publicacion_academica->setIdPublicacionAcademica($_POST['id_publicacion_academica'])) {
                    if ($publicacion_academica->setAnio($_POST['anio'])) {
                        if ($publicacion_academica->setTitulo($_POST['titulo'])) {
                            if ($publicacion_academica->setDescripcion($_POST['descripcion'])) {
                                if ($publicacion_academica->update()) {
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
                if ($publicacion_academica->setIdPublicacionAcademica($_POST['id_publicacion_academica'])) {
                    if ($publicacion_academica->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar la formacion academica del candidato');
                    }
                } else {
                    throw new Exception('No se ha encontrado la formacion academica del candidato');
                }
                break;
            case 'all':
                if ($publicacion_academica->setIdCandidato($_POST['id_candidato'])) {
                    $data = $publicacion_academica->all();
                }
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($publicacion_academica->setIdPublicacionAcademica($_POST['id_publicacion_academica'])) {
                    $data = $publicacion_academica->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
