<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

$id = $_GET['id'];

if ($_GET) {    
    
    $sql = Conexao::conecta()->prepare("SELECT * FROM `pessoas` WHERE id = $id");
    $sql->execute();
    if ($sql->rowCount() > 0) {

        foreach ($sql->fetchAll() as $value) {
            
            echo '<form id="formCadastroUsuario2">'.
                '<div class="form-row">'.
                    '<input type="hidden" id="txtId" value="'. $value['id'] .'">'.
                    '<div class="form-group col-md-6">'.
                        '<label>Usuário:</label><br>'.
                        '<input type="text" class="form-control required2" id="txtUsuario" value="' . $value['nome'] . '" placeholder="Ex.: Tarcisio dos Santos Souto" disabled required>'.
                    '</div>'.
                    '<div class="form-group col-md-6">'.
                        '<label>Data de Nascimento:</label><br>'.
                        '<input type="date" class="form-control required2" id="txtDataNasc" value="' . $value['dataNasc'] . '" disabled required>'.
                    '</div>'.
                '</div>'.
                '<div class="form-row">'.
                    '<div class="form-group col-md-4">'.
                        '<label>Idade:</label><br>'.
                        '<input type="text" class="form-control required2" id="txtIdade" value="' . $value['idade'] . '" placeholder="27" disabled>'.
                    '</div>'.
                    '<div class="form-group col-md-4">'.
                        '<label>CPF:</label><br>'.
                        '<input type="text" class="form-control required2" id="txtCPF" value="' . $value['cpf'] . '" placeholder="000.000.000-00" disabled>'.
                    '</div>'.
                    '<div class="form-group col-md-4">'.
                        '<label>Celular:</label><br>'.
                        '<input type="text" class="form-control required2" id="txtCelular" value="' . $value['celular'] . '" placeholder="(27) 99999-9999" disabled>'.
                    '</div>'.
                '</div>'.
                '<div class="form-row">'.
                    '<div class="form-group col-md-6">'.
                        '<label>E-mail:</label><br>'.
                        '<input type="email" class="form-control required2" id="txtEmail" value="' . $value['email'] . '" placeholder="tarcisio@tarcisio.com" required disabled>'.
                    '</div>'.
                    '<div class="form-group col-md-6">'.
                        '<label for="inputPassword4">Senha:</label>'.
                        '<input type="password" class="form-control required2" id="txtSenha" value="" placeholder="Senha" required disabled>'.
                    '</div>'.
                '</div>'.
                '<div class="form-row botoes_acao">'.
                    //'<div class="col-md-6"></div>'.
                    //'<div class="form-group col-md-12">'.
                            '<div class="col-">'.
                                //'<input class="btn btn-primary" onclick="habilitaEdicao()" type="button" value="Editar">'.
                                '<i class="fas fa-edit fa-2x" onclick="habilitaEdicao()"></i>'.
                            '</div>'.
                            '<div class="col-">'.
                                //'<input class="btn btn-warning" id="cancelarAlterar" onclick="desabilitaEdicao()" type="button" value="Cancelar" disabled>'.
                                '<i class="fas fa-window-close fa-2x" onclick="desabilitaEdicao()"></i>'.
                            '</div>'.
                            '<div class="col-">'.
                                //'<button class="btn btn-danger" id="excluirCadastro" id="btnDelete" onclick="excluirUsuario()">Excluir</button>'.
                                '<i class="fas fa-trash-alt fa-2x" onclick="excluirUsuario()"></i>'.
                            '</div>'.
                            '<div class="col-">'.
                                //'<button class="btn btn-success" id="btnAlterar" onclick="alteraCadastro()" disabled>Alterar</button>'.
                                '<i class="fas fa-user-edit fa-2x" id="btn_cadAuxUsuario"></i>'.
                                '<i class="fas fa-user-edit fa-2x" id="btn_cadUsuario" onclick="alteraCadastro()"></i>'.
                            '</div>'.
                    //'</div>'.
                '</div>'.
            '</form>';
        }
    }else{
        echo 'Não foi possível alterar.';
    }
    
}
