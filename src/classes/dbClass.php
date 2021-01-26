<?php
class db
{
    public function connect()
    {
        $dns = 'mysql:host=127.0.0.1:8889;dbname=stemwijzer';
        $user = 'root';
<<<<<<< Updated upstream
        $pass = '8269';
=======
        $pass = 'root';
>>>>>>> Stashed changes

        return new PDO($dns, $user, $pass);
    }
}
