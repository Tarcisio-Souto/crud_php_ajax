<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

    $id = $_SESSION['id'];    

    $query = Conexao::conecta()->prepare('SELECT * FROM `anotacao` WHERE fk_id_usuario = ? ORDER BY id_anotacao DESC;');
    $query->execute(array($id));
    
    if($query->rowCount() > 0){
        foreach($query->fetchAll() as $value){
            echo '<div class="row">'.
            '<div class="col-md-12">'.
                '<textarea id="areaAnotacoesCarregada'.$value['id_anotacao'].'" class="areaAnotacoesCarregada" disabled>'.$value['descricao'].'</textarea>'.
                '<i class="fas fa-check-square" onclick="editarAnotacao('.$value['id_anotacao'].')"></i>'.
                '<i class="fas fa-window-close fecharAnotacaoCarregada" id="fecharAnotacaoCarregada'.$value['id_anotacao'].'" onclick="abreFechaEdicaoAnotacao('.$value['id_anotacao'].')"></i>'.
                '<i class="fas fa-pen-square abrirAnotacaoCarregada'.$value['id_anotacao'].'" onclick="abreFechaEdicaoAnotacao('.$value['id_anotacao'].')"></i>'.
                '<i class="fas fa-trash" onclick="excluirAnotacao('.$value['id_anotacao'].')"></i>'.
                '</div>'.            
            '</div>';
        }
    }else{
        echo 'Não há registros.';
    }



?>