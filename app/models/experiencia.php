<?php
class Experiencia extends Validator
{
    private $id_experiencia = null;
    private $experiencia = null;

    public function setIdExperiencia($value)
    {
        if ($this->validateId($value)) {
            $this->id_experiencia = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setExperiencia($value)
    {
        if ($this->validateAlphabetic($value, 1, 255)) {
            $this->id_experiencia = $value;
            return true;
        } else {
            return false;
        }
    }
    //FUNCIONES CRUD
    public function create()
    {
        $sql = "INSERT INTO experiencia(id_candidato, desde, hasta, institucion, cargo, funcion, estado) VALUES (?,?,?,?,?,?,1)";
        $params = array($this->experiencia);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE experiencia SET id_candidato = ?, desde = ?, hasta = ?, institucion = ?, cargo = ?, funcion = ?, estado = ? WHERE id_experiencia=?";
        $params = array($this->experiencia, $this->id_experiencia);
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
        $sql = "SELECT * FROM experiencia WHERE estado=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM experiencia WHERE id_experiencia=?";
        $params = array($this->id_experiencia);
        return Database::getRow($sql, $params);
    }
}
?>