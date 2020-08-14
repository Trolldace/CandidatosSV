<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/departamento.php';
try {
    $departamento = new Departamento;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($departamento->setDepartamento($_POST['departamento'])) {
                    if ($departamento->create()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception("No se pudo crear el departamento");
                    }
                } else {
                    throw new Exception("Verifique el departamento");
                }
                break;
            case 'update':
                if ($departamento->setIdDepartamento($_POST['id_departamento'])) {
                    if ($departamento->setDepartamento($_POST['departamento'])) {
                        if ($departamento->create()) {
                            echo json_encode(true);
                        } else {
                            throw new Exception("No se pudo modificar el departamento");
                        }
                    } else {
                        throw new Exception("Verifique el departamento");
                    }
                } else {
                    throw new Exception('No se ha encontrado el departamento');
                }
                break;
            case 'delete':
                if ($departamento->setIdDepartamento($_POST['id_departamento'])) {
                    if ($departamento->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar el departamento');
                    }
                } else {
                    throw new Exception('No se ha encontrado el departamento');
                }
                break;
            case 'all':
                $data = $departamento->all();
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($departamento->setIdDepartamento($_POST['id_departamento'])) {
                    $data = $departamento->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
