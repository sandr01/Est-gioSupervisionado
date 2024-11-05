<?php

class Conexao {
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "engenharia2";

    public static function getConexao() {
        try {
            $conexao = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname, self::$username, self::$password);
            // set the PDO error mode to exception
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;

        } catch(PDOException $e) {
            throw $e;
        }
    }
}

?>
