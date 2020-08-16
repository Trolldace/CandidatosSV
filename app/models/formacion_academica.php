<?php
class FormacionAcademica extends Validator
{
    private $id_formacion_academica = null;
    private $id_candidato = null;
    private $id_titulo = null;
    private $titulo = null;
    private $descripcion = null;

    public function setIdFormacionAcademica($value)
    {
        if ($this->validateId($value)) {
            $this->id_formacion_academica = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdCandidato($value)
    {
        if ($this->validateId($value)) {
            $this->id_candidato = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdTitulo($value)
    {
        if ($this->validateId($value)) {
            $this->id_titulo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setTitulo($value)
    {
        if ($this->validateAlphanumeric($value, 1, 1000)) {
            $this->titulo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setDescripcion($value)
    {
        $this->descripcion = $value;
        return true;
    }

    public function create()
    {
        $sql = "INSERT INTO formacion_academica(id_candidato, id_titulo, titulo, descripcion) VALUES(?,?,?,?)";
        $params = array($this->id_candidato, $this->id_titulo, $this->titulo, $this->descripcion);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE formacion_academica SET id_titulo=?, titulo=?, descripcion=? WHERE id_formacion_academica=?";
        $params = array($this->id_titulo, $this->titulo, $this->descripcion, $this->id_formacion_academica);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE formacion_academica SET estado=0 WHERE id_formacion_academica=?";
        $params = array($this->id_formacion_academica);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM formacion_academica WHERE id_candidato=? AND estado=1";
        $params = array($this->id_candidato);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM formacion_academica WHERE id_formacion_academica=?";
        $params = array($this->id_formacion_academica);
        return Database::getRow($sql, $params);
    }
}
