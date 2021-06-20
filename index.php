<?php
    
    include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

    if(Painel::sessao() == true){
        header('Location: '.INCLUDE_PATH_MAIN);
    }else{        
        header('Location: '.INCLUDE_PATH_LOGIN);        
    }
    

?>