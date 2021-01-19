<?php
/**
 * Created by PhpStorm.
 * User: yoran
 * Date: 19-1-2021
 * Time: 09:54
 */

class db
{
    public function connect()
    {
        $dns = 'mysql:host=127.0.0.1;dbname=stemwijzer';
        $user = 'root';
        $pass = '8269';

        return new PDO($dns, $user, $pass);
    }
}