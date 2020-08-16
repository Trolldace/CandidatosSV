<?php
class PublicacionAcademica extends Validator
{
    private $id_publicacion_academica = null;
    private $id_candidato = null;
    private $anio = null;
    private $titulo = null;
    private $descripcion = null;
    public function setIdPublicacionAcademica($value)
    {
        if ($this->validateId($value)) {
            $this->id_publicacion_academica = $value;
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
    public function setAnio($value)
    {
        $this->anio = $value;
        return true;
    }
    public function setTitulo($value)
    {
        $this->titulo = $value;
        return true;
    }
    public function setDescripcion($value)
    {
        $this->descripcion = $value;
        return true;
    }

    public function create()
    {
        $sql = "INSERT INTO publicacion_academica(id_candidato, anio, titulo, descripcion) VALUES(?,?,?,?)";
        $params = array($this->id_candidato, $this->anio, $this->titulo, $this->descripcion);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE publicacion_academica SET anio=?, titulo=?, descripcion=? WHERE id_publicacion_academica=?";
        $params = array($this->anio, $this->titulo, $this->descripcion, $this->id_publicacion_academica);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE publicacion_academica SET estado=0 WHERE id_publicacion_academica=?";
        $params = array($this->id_publicacion_academica);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM publicacion_academica WHERE id_candidato=? AND estado=1";
        $params = array($this->id_candidato);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM publicacion_academica WHERE id_publicacion_academica=?";
        $params = array($this->id_publicacion_academica);
        return Database::getRow($sql, $params);
    }
}
