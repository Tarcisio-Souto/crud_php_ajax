<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === "DELETE") {
   
    /* Retorna os valores passados na requisição Ajax através do método PUT */

    // urldecode é uma função do PHP que trata da maneira correta os caracteres especiais.

    $id = urldecode(file_get_contents('php://input'));

    $lstVar = explode('&',$id);

    $AuxIdAnotacao = $lstVar[0];
    $AuxIdAnotacao2 = explode('=', $AuxIdAnotacao);
    $idAnotacao = $AuxIdAnotacao2[1];

    $query = Conexao::conecta()->prepare('DELETE FROM `anotacao` WHERE `id_anotacao` = ?');
    $query->execute(array($idAnotacao));

    if ($query->rowCount() > 0) {
        echo '<div class="cadSucesso">Anotação excluída com sucesso!</div>' .
            '<script>' .
            'setTimeout(function(){' .
            'var msg = document.getElementsByClassName("cadSucesso");' .
            'while(msg.length > 0){' .
            'msg[0].parentNode.removeChild(msg[0]);' .
            '}' .
            '}, 2000);' .
        '</script>';        

    }else{
        
    }


}
