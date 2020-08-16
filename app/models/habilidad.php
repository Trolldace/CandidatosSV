<?php
class Habilidad extends Validator
{
    private $id_habilidad = null;
    private $id_candidato = null;
    private $habilidad = null;
    private $detalle_habilidad = null;
    private $experiencia_habilidad = null;
    private $logros = null;

    public function setIdHabilidad($value)
    {
        if ($this->validateId($value)) {
            $this->id_habilidad = $value;
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
    public function setHabilidad($value)
    {
        $this->habilidad = $value;
        return true;
    }
    public function setDetalleHabilidad($value)
    {
        $this->detalle_habilidad = $value;
        return true;
    }
    public function setExperienciaHabilidad($value)
    {
        $this->experiencia_habilidad = $value;
        return true;
    }
    public function setLogros($value)
    {
        $this->logros = $value;
        return true;
    }

    public function create()
    {
        $sql = "INSERT INTO habilidad(id_candidato, habilidad, detalle_habilidad, experiencia_habilidad,logros) VALUES(?,?,?,?,?)";
        $params = array($this->id_candidato, $this->habilidad, $this->detalle_habilidad, $this->experiencia_habilidad, $this->logros);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE habilidad SET habilidad=?, detalle_habilidad=?, experiencia_habilidad=?, logros=? WHERE id_habilidad=?";
        $params = array($this->habilidad, $this->detalle_habilidad, $this->experiencia_habilidad, $this->logros, $this->id_habilidad);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE habilidad SET estado=0 WHERE id_habilidad=?";
        $params = array($this->id_habilidad);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM habilidad WHERE id_candidato=? AND estado=1";
        $params = array($this->id_candidato);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM habilidad WHERE id_habilidad=?";
        $params = array($this->id_habilidad);
        return Database::getRow($sql, $params);
    }
}
