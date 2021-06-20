<?php

    class Conexao{

        private static $conn;

        static function conecta()
        {
            
            self::$conn = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'',''.USER.'',''.PASSWORD);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
            return self::$conn;

        }        

    }


?>