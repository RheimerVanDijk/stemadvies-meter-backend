<?php
class db
{
    public function connect()
    {
        $dns = 'mysql:host=localhost;dbname=stemwijzer';
        $user = 'root';
        $pass = '8269';

        return new PDO($dns, $user, $pass);
    }
}
