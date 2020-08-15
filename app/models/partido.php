<?php
class Partido extends Validator
{
    private $id_partido = null;
    private $partido = null;
    private $logo = null;

    public function setIdPartido($value)
    {
        if ($this->validateId($value)) {
            $this->id_partido = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setPartido($value)
    {
        if ($this->validateAlphabetic($value, 1, 255)) {
            $this->id_partido = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setLogo($file_name)
    {
        if ($this->validateImage($file_name, $this->logo, '../../../web/media/img/partido/')) {
            $this->logo = $this->imageName;
            return true;
        } else {
            return false;
        }
    }
    //FUNCIONES CRUD
    public function create()
    {
        $sql = "INSERT INTO partido(partido,logo,estado) VALUES (?,?,1)";
        $params = array($this->partido, $this->logo);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE partido SET partido = ?, logo=? WHERE id_partido=?";
        $params = array($this->partido, $this->logo, $this->id_partido);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE partido SET estado=0 WHERE id_partido=?";
        $params = array($this->id_partido);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM partido WHERE estado=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM partido WHERE id_partido=?";
        $params = array($this->id_partido);
        return Database::getRow($sql, $params);
    }
}
