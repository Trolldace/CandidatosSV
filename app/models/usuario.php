<?php
class Usuario extends Validator
{
    private $id_usuario = null;
    private $nombre = null;
    private $apellido = null;
    private $id_tipo_usuario = null;
    private $correo = null;
    private $clave = null;

    public function setIdUsuario($value)
    {
        if ($this->validateId($value)) {
            $this->id_usuario = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setNombre($value)
    {
        if ($this->validateAlphanumeric($value, 1, 255)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setApellido($value)
    {
        if ($this->validateAlphanumeric($value, 1, 255)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdTipoUsuario($value)
    {
        if ($this->validateId($value)) {
            $this->id_tipo_usuario = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }
    //FUNCIONES
    public function crearUsuario()
    {
        $sql    = "INSERT INTO usuario(nombre,apellido,id_tipo_usuario,correo, clave) VALUES (?,?,?,?,?)";
        $params = array($this->nombre, $this->apellido, $this->id_tipo_usuario, $this->correo, password_hash($this->clave, PASSWORD_DEFAULT));
        return Database::executeRow($sql, $params);
    }

    // Modificar informacion de usuario
    public function modificarUsuario()
    {
        $sql    = "UPDATE usuario SET nombre = ?, apellido = ?, id_tipo_usuario=?, correo=? WHERE id_usuario = ?";
        $params = array($this->nombre, $this->apellido, $this->id_tipo_usuario, $this->correo, $this->id_usuario);
        return Database::executeRow($sql, $params);
    }
    public function modificarClave()
    {
        $sql    = "UPDATE usuario SET clave = ? WHERE id_usuario = ?";
        $params = array(password_hash($this->clave, PASSWORD_DEFAULT), $this->id_usuario);
        return Database::executeRow($sql, $params);
    }
    public function recuperarClave()
    {
        $sql    = "UPDATE usuario SET clave = ? WHERE correo = ?";
        $params = array(password_hash($this->clave, PASSWORD_DEFAULT), $this->correo);
        return Database::executeRow($sql, $params);
    }
    public function eliminarUsuario()
    {
        $sql    = "UPDATE usuario SET estado = 0 WHERE id_usuario = ?";
        $params = array($this->id_usuario);
        return Database::executeRow($sql, $params);
    }
    public function verificarExistencia()
    {
        $sql = "SELECT COUNT(*) as conteo FROM usuario WHERE correo=?";
        $params = array($this->correo);
        return Database::getRow($sql, $params);
    }
    public function iniciarSesion()
    {
        $sql = "SELECT * FROM usuario WHERE correo=? AND estado=1";
        $params = array($this->correo);
        $data = Database::getRow($sql, $params);
        if ($data) {
            if (password_verify($this->clave, $data['clave'])) {
                return $data;
            } else {
                return 'clave';
            }
        } else {
            return 'correo';
        }
    }
    public function cerrarSesion()
    {
        return session_destroy();
    }
    public function obtenerUsuarios()
    {
        $sql = "SELECT u.*, tu.tipo_usuario FROM usuario u INNER JOIN tipo_usuario tu ON tu.id_tipo_usuario=u.id_tipo_usuario WHERE u.estado=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    public function obtenerUsuario()
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario=?";
        $params = array($this->id_usuario);
        return Database::getRow($sql, $params);
    }
    public function buscarUsuario($texto)
    {
        $sql = "SELECT * FROM usuario WHERE estado=1 AND nombre LIKE " . $texto . " OR estado=1 AND apellido LIKE " . $texto . " OR estado=1 AND correo LIKE " . $texto . "";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
}
