<?php
class Database
{
    private $hostname = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "la_sombra";
    private $charset = "utf8";
    private $server = "mysql:host=localhost;dbname=la_sombra"; // Ajuste de espacio en blanco
    
    function conectarBD()
    {
        try {
            $conexion = "mysql:host=".$this->hostname.";dbname=".$this->database.";charset=".$this->charset;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false];            
            $pdo = new PDO($conexion, $this->user, $this->password, $options);
            return $pdo;
            } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

   /* function desconectarBD()
    {
        try {
            $this->PDOlOCAL = null;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    */
}
?>