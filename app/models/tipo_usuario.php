<?php
class TipoUsuario extends Validator{
    public function obtenerTipoUsuario()
    {
        $sql ="SELECT * FROM tipo_usuario WHERE estado=1";
        $params = array(null);
        return Database::getRows($sql, $params);
    }
}