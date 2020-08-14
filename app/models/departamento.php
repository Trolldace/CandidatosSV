<?php
class Departamento extends Validator
{
    private $id_departamento = null;
    private $departamento = null;

    public function setIdDepartamento($value)
    {
        if ($this->validateId($value)) {
            $this->id_departamento = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDepartamento($value)
    {
        if ($this->validateAlphabetic($value, 1, 255)) {
            $this->id_departamento = $value;
            return true;
        } else {
            return false;
        }
    }
    //FUNCIONES CRUD
    public function create()
    {
        $sql = "INSERT INTO departamento(departamento,estado) VALUES (?,1)";
        $params = array($this->departamento);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE departamento SET departamento = ? WHERE id_departamento=?";
        $params = array($this->departamento, $this->id_departamento);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE departamento SET estado=0 WHERE id_departamento=?";
        $params = array($this->id_departamento);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM departamento WHERE estado=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM departamento WHERE id_departamento=?";
        $params = array($this->id_departamento);
        return Database::getRow($sql, $params);
    }
}
