<?php
class Propuesta extends Validator
{
    private $id_propuesta = null;
    private $id_candidato = null;
    private $propuesta = null;
    private $descripcion = null;

    public function setIdPropuesta($value)
    {
        if ($this->validateId($value)) {
            $this->id_propuesta = $value;
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
    public function setPropuesta($value)
    {
        $this->id_propuesta = $value;
        return true;
    }
    public function setDescripcion($value)
    {
        $this->descripcion = $value;
        return true;
    }

    public function create()
    {
        $sql = "INSERT INTO propuesta(id_candidato, propuesta, descripcion) VALUES(?,?,?)";
        $params = array($this->id_candidato, $this->propuesta, $this->descripcion);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE propuesta SET propuesta=?, descripcion=? WHERE id_propuesta=?";
        $params = array($this->propuesta, $this->descripcion, $this->id_propuesta);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE propuesta SET estado=0 WHERE id_propuesta=?";
        $params = array($this->id_propuesta);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM propuesta WHERE id_candidato=? AND estado=1";
        $params = array($this->id_candidato);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM propuesta WHERE id_propuesta=?";
        $params = array($this->id_propuesta);
        return Database::getRow($sql, $params);
    }
}
