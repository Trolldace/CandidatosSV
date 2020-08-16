<?php
class Experiencia extends Validator
{
    private $id_experiencia = null;
    private $id_candidato = null;
    private $desde = null;
    private $hasta = null;
    private $institucion = null;
    private $cargo = null;
    private $funcion = null;

    public function setIdExperiencia($value)
    {
        if ($this->validateId($value)) {
            $this->id_experiencia = $value;
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
    public function setDesde($value)
    {
        $this->desde = $value;
        return true;
    }
    public function setHasta($value)
    {
        $this->hasta = $value;
        return true;
    }
    public function setInstitucion($value)
    {
        $this->institucion = $value;
        return true;
    }
    public function setCargo($value)
    {
        $this->cargo = $value;
        return true;
    }
    public function setFuncion($value)
    {
        $this->funcion = $value;
        return true;
    }
    //FUNCIONES CRUD
    public function create()
    {
        $sql = "INSERT INTO experiencia(id_candidato, desde, hasta, institucion, cargo, funcion) VALUES (?,?,?,?,?,?)";
        $params = array($this->id_candidato, $this->desde, $this->hasta, $this->institucion, $this->cargo, $this->funcion);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE experiencia SET desde = ?, hasta = ?, institucion = ?, cargo = ?, funcion = ? WHERE id_experiencia=?";
        $params = array($this->desde, $this->hasta, $this->institucion, $this->cargo, $this->funcion, $this->id_experiencia);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE experiencia SET estado=0 WHERE id_experiencia=?";
        $params = array($this->id_experiencia);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM experiencia WHERE id_candidato=? AND estado=1";
        $params = array($this->id_candidato);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM experiencia WHERE id_experiencia=?";
        $params = array($this->id_experiencia);
        return Database::getRow($sql, $params);
    }
}
