<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/usuario.php';
require_once APP_PATH . '/app/helpers/generator_password.php';
require APP_PATH . '/app/helpers/mail.php';
//activando una nueva sesion
session_start();
try {
    //inicializando la clase usuario
    $usuario = new Usuario;
    $password = new GeneratorPassword;
    $mail = new Correo;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'crear':
                if ($usuario->setNombre($_POST['nombre'])) {
                    if ($usuario->setApellido($_POST['apellido'])) {
                        if ($usuario->setIdTipoUsuario($_POST['id_tipo_usuario'])) {
                            if ($usuario->setCorreo($_POST['correo'])) {
                                $clave = $password->generator();
                                if ($usuario->setClave($clave)) {
                                    if ($usuario->crearUsuario()) {
                                        if ($mail->enviarCredenciales($_POST['nombre'] . ' ' . $_POST['apellido'], $_POST['correo'], $clave)) {
                                            echo json_encode(true);
                                        } else {
                                            echo json_encode("No se envió el correo. Entregar la clave al usuario: " . $clave);
                                        }
                                    } else {
                                        throw new Exception(Database::getException());
                                    }
                                } else {
                                    throw new Exception('Verifique la clave');
                                }
                            } else {
                                throw new Exception('Verifique el correo');
                            }
                        } else {
                            throw new Exception('Verifique el tipo usuario');
                        }
                    } else {
                        throw new Exception('Verifique el apellido');
                    }
                } else {
                    throw new Exception('Verifique el nombre');
                }
                break;
            case 'modificar':
                if ($usuario->setIdUsuario($_POST['id_usuario'])) {
                    if ($usuario->setNombre($_POST['nombre'])) {
                        if ($usuario->setApellido($_POST['apellido'])) {
                            if ($usuario->setIdTipoUsuario($_POST['id_tipo_usuario'])) {
                                if ($usuario->setCorreo($_POST['correo'])) {
                                    if ($usuario->modificarUsuario()) {
                                        echo json_encode(true);
                                    } else {
                                        throw new Exception('No se pudo modificar el usuario');
                                    }
                                } else {
                                    throw new Exception('Verifique el correo');
                                }
                            } else {
                                throw new Exception('Verifique el tipo usuario');
                            }
                        } else {
                            throw new Exception('Verifique el apellido');
                        }
                    } else {
                        throw new Exception('Verifique el nombre');
                    }
                } else {
                    throw new Exception('No se encontro el usuario');
                }
                break;
            case 'eliminar':
                if ($usuario->setIdUsuario($_POST['id_usuario'])) {
                    if ($usuario->eliminarUsuario()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception(Database::getException());
                    }
                } else {
                    throw new Exception('No se encontro el usuario');
                }
                break;
            case 'modificar_clave':
                if ($usuario->setIdUsuario($_POST['id_usuario'])) {
                    $clave = $password->generator();
                    if ($usuario->setClave($clave)) {
                        if ($usuario->modificarClave()) {
                            echo json_encode($clave);
                        } else {
                            throw new Exception(Database::getException());
                        }
                    } else {
                        throw new Exception('Verifique la clave');
                    }
                } else {
                    throw new Exception('No se encontro el usuario');
                }
                break;
            case 'recuperar':
                if ($usuario->setCorreo($_POST['correo'])) {
                    $ex = $usuario->verificarExistencia();
                    if ($ex['conteo'] > 0) {
                        $clave = $password->generator();
                        if ($usuario->setClave($clave)) {
                            if ($usuario->recuperarClave()) {
                                echo json_encode($clave);
                            } else {
                                throw new Exception(Database::getException());
                            }
                        } else {
                            throw new Exception('Verifique la clave');
                        }
                    } else {
                        throw new Exception('Correo no encontrado');
                    }
                } else {
                    throw new Exception('Verifique el correo');
                }
                break;
            case 'iniciar_sesion':
                if ($usuario->setCorreo($_POST['correo'])) {
                    if ($usuario->setClave($_POST['clave'])) {
                        $data = $usuario->iniciarSesion();
                        if ($data == 'correo') {
                            throw new Exception('Correo no encontrado.');
                        } elseif ($data == 'clave') {
                            throw new Exception('Clave incorrecta.');
                        } else {
                            $_SESSION['id_usuario'] = $data['id_usuario'];
                            $_SESSION['nombre'] = $data['nombre'] . ' ' . $data['apellido'];
                            $_SESSION['id_tipo_usuario'] = $data['id_tipo_usuario'];
                            echo json_encode(true);
                        }
                    }
                } else {
                    throw new Exception('Verifique el correo');
                }
                break;
            case 'cerrar_sesion':
                echo json_encode($usuario->cerrarSesion());
                break;
            case 'todo':
                $data = $usuario->obtenerUsuarios();
                echo json_encode($data);
                break;
            case 'uno':
                $data = null;
                if ($usuario->setIdUsuario($_POST['id_usuario'])) {
                    $data = $usuario->obtenerUsuario();
                }
                echo json_encode($data);
                break;
            case 'buscar':
                $data = $usuario->buscarUsuario($_POST['buscador']);
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
