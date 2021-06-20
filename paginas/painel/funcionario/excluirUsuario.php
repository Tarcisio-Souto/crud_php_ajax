<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

if($_GET){
    
    $id = $_GET['id'];
    
    $query = Conexao::conecta()->prepare('DELETE FROM `pessoas` WHERE id = ?');
    $query->execute(array($id));

    if($query->rowCount() > 0){
        echo '<div class="cadSucesso">Cadastro excluído com sucesso</div>'.
        '<script>'.
        'document.getElementById("formCadastroUsuario2").style.display = "none";'.
        'setTimeout(function(){' .
            'var msg = document.getElementsByClassName("cadSucesso");' .
            'while(msg.length > 0){' .
            'msg[0].parentNode.removeChild(msg[0]);' .
            '}' .
            '}, 2000);' .
        '</script>';
    }
    

}

