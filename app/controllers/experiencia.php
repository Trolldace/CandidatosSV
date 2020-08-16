<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/experiencia.php';
try {
    $experiencia = new Experiencia;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($experiencia->setExperiencia($_POST['experiencia'])) {
                    if ($experiencia->create()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception("No se pudo crear la experiencia del candidato");
                    }
                } else {
                    throw new Exception("Verifique la experiencia del candidato");
                }
                break;
            case 'update':
                if ($experiencia->setIdExperiencia($_POST['id_experiencia'])) {
                    if ($experiencia->setExperiencia($_POST['experiencia'])) {
                        if ($experiencia->create()) {
                            echo json_encode(true);
                        } else {
                            throw new Exception("No se pudo modificar la experiencia del candidato");
                        }
                    } else {
                        throw new Exception("Verifique la experiencia del candidato");
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
                $data = $experiencia->all();
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
?>