<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/titulo.php';
try {
    $titulo = new Titulo;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($titulo->setTitulo($_POST['titulo'])) {
                    if ($titulo->create()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception("No se pudo crear el titulo");
                    }
                } else {
                    throw new Exception("Verifique el titulo");
                }
                break;
            case 'update':
                if ($titulo->setIdTitulo($_POST['id_titulo'])) {
                    if ($titulo->setTitulo($_POST['titulo'])) {
                        if ($titulo->update()) {
                            echo json_encode(true);
                        } else {
                            throw new Exception("No se pudo modificar el titulo");
                        }
                    } else {
                        throw new Exception("Verifique el titulo");
                    }
                } else {
                    throw new Exception('No se ha encontrado el titulo');
                }
                break;
            case 'delete':
                if ($titulo->setIdTitulo($_POST['id_titulo'])) {
                    if ($titulo->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar el titulo');
                    }
                } else {
                    throw new Exception('No se ha encontrado el titulo');
                }
                break;
            case 'all':
                $data = $titulo->all();
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($titulo->setIdTitulo($_POST['id_titulo'])) {
                    $data = $titulo->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
