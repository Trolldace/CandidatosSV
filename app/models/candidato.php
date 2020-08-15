<?php
class Candidato extends Validator
{
    private $id_candidato = null;
    private $nombre = null;
    private $apellido = null;
    private $foto = null;
    private $id_departamento = null;
    private $id_partido = null;
    private $perfil_profesional = null;

    public function setIdCandidato($value)
    {
        if ($this->validateId($value)) {
            $this->id_candidato = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setNombre($value)
    {
        if ($this->validateAlphabetic($value, 1, 255)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setApellido($value)
    {
        if ($this->validateAlphabetic($value, 1, 255)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setFoto($file_name)
    {
        if ($this->validateImage($file_name, $this->foto, '../../../web/media/img/candidato/')) {
            $this->foto = $this->imageName;
            return true;
        } else {
            return false;
        }
    }
    public function setIdDepartamento($value)
    {
        if ($this->validateId($value)) {
            $this->id_departamento = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdPartido($value)
    {
        if ($this->validateId($value)) {
            $this->id_partido = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setPerfilProfesional($value)
    {
        $this->perfil_profesional = $value;
        return true;
    }

    public function crear()
    {
        $sql = "INSERT INTO candidato(nombre,apellido,foto,id_departamento,id_partido,perfil_profesional) VALUES(?,?,?,?,?,?)";
        $params = array($this->nombre, $this->apellido, $this->foto, $this->id_departamento, $this->id_partido, $this->perfil_profesional);
        return Database::executeRow($sql, $params);
    }
    public function updateNoImage()
    {
        $sql = "UPDATE candidato SET nombre=?,apellido=?,id_departamento=?,id_partido=?,perfil_profesional=? WHERE id_candidato=?";
        $params = array($this->nombre, $this->apellido, $this->id_departamento, $this->id_partido, $this->perfil_profesional, $this->id_candidato);
        return Database::executeRow($sql, $params);
    }
    public function updateImage()
    {
        $sql = "UPDATE candidato SET nombre=?,apellido=?,foto=?,id_departamento=?,id_partido=?,perfil_profesional=? WHERE id_candidato=?";
        $params = array($this->nombre, $this->apellido, $this->foto, $this->id_departamento, $this->id_partido, $this->perfil_profesional, $this->id_candidato);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE candidato SET estado=0 WHERE id_candidato=?";
        $params = array($this->id_candidato);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM candidato WHERE estado=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    public function allPublic()
    {
        $sql = "SELECT id_candidato, nombre, apellido, foto FROM candidato WHERE id_departamento=? AND id_partido=? AND estado=1";
        $params = array($this->id_departamento, $this->id_partido);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM candidato WHERE id_candidato=?";
        $params = array($this->id_candidato);
        return Database::getRow($sql, $params);
    }
}
