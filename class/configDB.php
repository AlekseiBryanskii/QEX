<?php
class configDataBase
{
    private $pdo;
    public function setConnect($hostBD,$nameBD,$loginBD,$passwordBD)
    {
        try
        {
            $this->pdo = new PDO('mysql:host='.$hostBD.';dbname='.$nameBD.'',$loginBD,$passwordBD);
            return $this->pdo;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function getConnect()
    {
        return $this->pdo;
    }
}