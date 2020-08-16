<?php
class Titulo extends Validator
{
    private $id_titulo = null;
    private $titulo = null;

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
        if ($this->validateAlphabetic($value, 1, 255)) {
            $this->id_titulo = $value;
            return true;
        } else {
            return false;
        }
    }
    //FUNCIONES CRUD
    public function create()
    {
        $sql = "INSERT INTO titulo(titulo,estado) VALUES (?,1)";
        $params = array($this->titulo);
        return Database::executeRow($sql, $params);
    }
    public function update()
    {
        $sql = "UPDATE titulo SET titulo = ? WHERE id_titulo=?";
        $params = array($this->titulo, $this->id_titulo);
        return Database::executeRow($sql, $params);
    }
    public function delete()
    {
        $sql = "UPDATE titulo SET estado=0 WHERE id_titulo=?";
        $params = array($this->id_titulo);
        return Database::executeRow($sql, $params);
    }
    public function all()
    {
        $sql = "SELECT * FROM titulo WHERE estado=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
    public function one()
    {
        $sql = "SELECT * FROM titulo WHERE id_titulo=?";
        $params = array($this->id_titulo);
        return Database::getRow($sql, $params);
    }
}
?>