<?php


    if(session_status() == PHP_SESSION_NONE){
        session_start();

        $autoload = function($class){
            include('classes/'.$class.'.php');
        };
    
        spl_autoload_register($autoload);

        define('INCLUDE_PATH_BEGIN','http://localhost/crud_single_page_application/');
        define('INCLUDE_PATH', INCLUDE_PATH_BEGIN.'paginas/');
        define('INCLUDE_PATH_STYLE', INCLUDE_PATH_BEGIN.'estilo/style.css');
        define('INCLUDE_PATH_STYLE_PAINEL', INCLUDE_PATH_BEGIN.'estilo/style_painel.css');
        define('INCLUDE_PATH_LOGIN', INCLUDE_PATH.'login/');
        define('INCLUDE_PATH_MAIN', INCLUDE_PATH.'painel/');
        define('INCLUDE_PATH_JS', INCLUDE_PATH_BEGIN.'js/dadosUsuarioAjax.js');
        define('INCLUDE_PATH_VIEW_USER', INCLUDE_PATH_MAIN.'visualizar_usuario.php');

        define('HOST','localhost');
        define('DATABASE', 'empresa');
        define('USER','root');
        define('PASSWORD', '');

    }


?>