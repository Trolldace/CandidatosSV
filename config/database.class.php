<?php
//Clase Database
class Database
{
    //Declarando variables para las diferentes funciones
    private static $connection = null;
    private static $statement  = null;
    private static $id         = null;
    private static $error      = null;

    //Funcion de conexion con la base
    private function connect()
    {
        //variable con el nombre del server
        $server   = "localhost";
        //variable con el nombre de la base
        $database = "candidatossv";
        //variable con el usuario de la base
        $username = "root";
        //variable con la contra de la base
        $password = "";
        try {
            //realizando conexion
            @self::$connection = new PDO("mysql:host=$server; dbname=$database; charset=utf8", $username, $password);
        } catch (PDOException $exception) {
            //mostrando el tipo de excepcion al realizar la conexion
            throw new Exception($exception->getCode());
        }
    }
    //Funcion para desconectar
    private function desconnect()
    {
        self::$error      = self::$statement->errorInfo();
        self::$connection = null;
    }
    //Funcion para ejectuar una consulta
    public static function executeRow($query, $values)
    {
        //Abriendo conexion
        self::connect();
        //preparando la consulta
        self::$statement = self::$connection->prepare($query);
        //ejecutando la consulta con las variables
        $state           = self::$statement->execute($values);
        //agregando el id de la consulta realizada
        self::$id        = self::$connection->lastInsertId();
        //
        self::desconnect();
        return $state;
    }
    //Funcion para obtener un solo registro
    public static function getRow($query, $values)
    {
        self::connect();
        self::$statement = self::$connection->prepare($query);
        self::$statement->execute($values);
        self::desconnect();
        return self::$statement->fetch(PDO::FETCH_ASSOC);
    }
    //Funcion para obtener varios registros
    public static function getRows($query, $values)
    {
        self::connect();
        self::$statement = self::$connection->prepare($query);
        self::$statement->execute($values);
        self::desconnect();
        return self::$statement->fetchAll(PDO::FETCH_ASSOC);
    }
    //Funcion para obtener el ultimo id usado
    public static function getLastRowId()
    {
        return self::$id;
    }
    //Funcion para obtener excepcion
    public static function getException()
    {
        if (self::$error[0] == "00000") {
            return false;
        } else {
            return self::$error[1];
        }
    }
}
