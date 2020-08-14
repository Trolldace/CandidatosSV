<?php
class GeneratorPassword
{
    public function generator()
    {
        //Caracteres a usar
        $caracteres     = '0123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //cantidad de caracteres
        $caractereslong = strlen($caracteres);
        //variable que se llenara con nuestra nueva contraseña
        $clave          = '';
        //for para para llenar la variable clave
        for ($i = 0; $i < 8; $i++) {
            //concatenandole a la clave el valor que salga del random
            $clave .= $caracteres[rand(0, $caractereslong - 1)];
        }
        //retornando contraseña
        return $clave;
    }
}
