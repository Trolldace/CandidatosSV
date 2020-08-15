<?php
class Red extends Validator
{
    private $id_red = null;
    private $red = null;
    private $logo = null;

    public function setIdRed($value)
    {
        if ($this->validateId($value)) {
            $this->id_red = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setRed($value)
    {
        if ($this->validateAlphabetic($value, 1, 255)) {
            $this->id_red = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setLogo($file_name)
    {
        if ($this->validateImage($file_name, $this->logo, '../../../web/media/img/red/')) {
            $this->logo = $this->imageName;
            return true;
        } else {
            return false;
        }
    }
    //FUNCIONES CRUD
    public function create()
    {
        $sql = "INSERT INTO red(red,logo,estado) VALUES (?,?,1)";
        $params = array($this->red, $this->logo);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE red SET red = ?, logo=? WHERE id_red=?";
        $params = array($this->red, $this->logo, $this->id_red);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE red SET estado=0 WHERE id_red=?";
        $params = array($this->id_red);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM red WHERE estado=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM red WHERE id_red=?";
        $params = array($this->id_red);
        return Database::getRow($sql, $params);
    }
}
