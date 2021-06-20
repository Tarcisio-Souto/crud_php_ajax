<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

if ($_POST) {

    $id = $_SESSION['id'];
    $txtAnotacoes = $_POST['txtAnotacoes'];

    if (Anotacoes::validaAnotacao($txtAnotacoes)) {
        
        $query = Conexao::conecta()->prepare('INSERT INTO `anotacao` (descricao, fk_id_usuario) VALUES (?,?);');
        $query->execute(array($txtAnotacoes, $id));

        if ($query->rowCount() > 0) {
            echo '<div class="cadSucesso">Anotação registrada com sucesso!</div>' .
                '<script>' .
                'setTimeout(function(){' .
                'var msg = document.getElementsByClassName("cadSucesso");' .
                'while(msg.length > 0){' .
                'msg[0].parentNode.removeChild(msg[0]);' .
                '}' .
                '}, 2000);' .
                '</script>';
        } else {
            echo '<script>alert("Não foi possível registrar sua anotação. Contacte o administrador do site.");</script>';
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
