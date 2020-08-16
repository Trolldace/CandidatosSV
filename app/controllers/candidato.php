<?php
date_default_timezone_set('America/El_Salvador');
require_once '../../config/app.php';
require_once APP_PATH . '/app/models/candidato.php';
try {
    $candidato = new Candidato;
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'create':
                if ($candidato->setNombre($_POST['nombre'])) {
                    if ($candidato->setApellido($_POST['apellido'])) {
                        if ($candidato->setIdDepartamento($_POST['id_departamento'])) {
                            if ($candidato->setIdPartido($_POST['id_partido'])) {
                                if ($candidato->setPerfilProfesional($_POST['perfil_profesional'])) {
                                    if ($candidato->setFoto($_FILES['foto'])) {
                                        if ($candidato->create()) {
                                            echo json_encode(true);
                                        } else {
                                            throw new Exception("No se pudo crear el candidato");
                                        }
                                    } else {
                                        throw new Exception($candidato->imageError);
                                    }
                                } else {
                                    throw new Exception("Verifique el perfil profesional");
                                }
                            } else {
                                throw new Exception("Seleccione el partido");
                            }
                        } else {
                            throw new Exception("Seleccione el departamento");
                        }
                    } else {
                        throw new Exception("Verifique el apellido");
                    }
                } else {
                    throw new Exception("Verifique el nombre");
                }
                break;
            case 'update':
                if ($candidato->setIdCandidato($_POST['id_candidato'])) {
                    if ($candidato->setNombre($_POST['nombre'])) {
                        if ($candidato->setApellido($_POST['apellido'])) {
                            if ($candidato->setIdDepartamento($_POST['id_departamento'])) {
                                if ($candidato->setIdPartido($_POST['id_partido'])) {
                                    if ($candidato->setPerfilProfesional($_POST['perfil_profesional'])) {
                                        if (isset($_POST['foto'])) {
                                            if ($candidato->updateNoImage()) {
                                                echo json_encode(true);
                                            } else {
                                                throw new Exception("No se pudo modificar el candidato");
                                            }
                                        } else {
                                            if ($candidato->setFoto($_FILES['foto'])) {
                                                if ($candidato->updateImage()) {
                                                    echo json_encode(true);
                                                } else {
                                                    throw new Exception("No se pudo modificar el candidato");
                                                }
                                            } else {
                                                throw new Exception($candidato->imageError);
                                            }
                                        }
                                    } else {
                                        throw new Exception("Verifique el perfil profesional");
                                    }
                                } else {
                                    throw new Exception("Seleccione el partido");
                                }
                            } else {
                                throw new Exception("Seleccione el departamento");
                            }
                        } else {
                            throw new Exception("Verifique el apellido");
                        }
                    } else {
                        throw new Exception("Verifique el nombre");
                    }
                } else {
                    throw new Exception('No se ha encontrado el candidato');
                }
                break;
            case 'delete':
                if ($candidato->setIdCandidato($_POST['id_candidato'])) {
                    if ($candidato->delete()) {
                        echo json_encode(true);
                    } else {
                        throw new Exception('No se pudo eliminar el candidato');
                    }
                } else {
                    throw new Exception('No se ha encontrado el candidato');
                }
                break;
            case 'all':
                $data = $candidato->all();
                echo json_encode($data);
                break;
            case 'allPublic':
                $data = null;
                if ($candidato->setIdDepartamento($_POST['id_departamento'])) {
                    if ($candidato->setIdPartido($_POST['id_partido'])) {
                        $data = $candidato->allPublic();
                    }
                }
                echo json_encode($data);
                break;
            case 'one':
                $data = null;
                if ($candidato->setIdcandidato($_POST['id_candidato'])) {
                    $data = $candidato->one();
                }
                echo json_encode($data);
                break;
        }
    }
} catch (Exception $error) {
    echo json_encode($error->getMessage());
}
