<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

$metodo = $_SERVER['REQUEST_METHOD'];


if ($metodo === 'PUT') {

    /* Retorna os valores passados na requisição Ajax através do método PUT */

    // urldecode é uma função do PHP que trata da maneira correta os caracteres especiais.

    $conteudo = urldecode(file_get_contents('php://input'));

    $lstVar = explode('&',$conteudo);

    $AuxIdAnotacao = $lstVar[0];
    $AuxIdAnotacao2 = explode('=', $AuxIdAnotacao);
    $idAnotacao = $AuxIdAnotacao2[1];

    $AuxTxtAnotacao = $lstVar[1];
    $AuxTxtAnotacao2 = explode('=', $AuxTxtAnotacao);
    $txtAnotacao = $AuxTxtAnotacao2[1];

    if (Anotacoes::validaAnotacao($txtAnotacao)) {
        $query = Conexao::conecta()->prepare('UPDATE `anotacao` SET descricao = ? WHERE id_anotacao = ?');
        $query->execute(array($txtAnotacao, $idAnotacao));

        if ($query->rowCount() > 0) {
            echo '<div class="cadSucesso">Anotação alterada com sucesso!</div>' .
                '<script>' .
                'setTimeout(function(){' .
                'var msg = document.getElementsByClassName("cadSucesso");' .
                'while(msg.length > 0){' .
                'msg[0].parentNode.removeChild(msg[0]);' .
                '}' .
                '}, 2000);' .
                '</script>';
        }
    }else{
        echo '<script>' .
        'setTimeout(function(){' .
        'var msg = document.getElementsByClassName("divErros");' .
        'while(msg.length > 0){' .
        'msg[0].parentNode.removeChild(msg[0]);' .
        '}' .
        '}, 2000);' .
        '</script>';
    }    
}
