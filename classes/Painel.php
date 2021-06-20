<?php

    class Painel{

        static function sessao()
        {
            return isset($_SESSION['login']) ? true : false;
        }
        
    
    }
    

?>