<?php
class db
{
    public function connect()
    {
        $dns = 'mysql:host=localhost;dbname=stemwijzer';
        $user = 'root';
        $pass = '';

        return new PDO($dns, $user, $pass);
    }
}