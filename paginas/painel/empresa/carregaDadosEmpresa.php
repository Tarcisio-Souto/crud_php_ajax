<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'GET') {

    $conn = Conexao::conecta()->prepare('SELECT * FROM `cadastro_empresa`');
    $conn->execute();

    if ($conn->rowCount() > 0) {

        foreach ($conn->fetchAll() as $value) {

            echo '<div id="resultadoCadastroEmpresa"></div>'.
                
                '<div class="container-fluid">'.                    
                    '<div class="row">'.
                        '<div class="col-md-12">'.
                            '<form class="formCadastroEmpresa" id="formCadastroEmpresa">'.
                                '<div class="form-row">'.
                                    '<div class="form-group col-md-6">'.
                                        '<label>Nome Empresarial:</label><br>'.
                                        '<input type="text" class="form-control required3" name="txtNomeEmpresa" id="txtNomeEmpresa" value="'.$value['nome_empresarial'].'" placeholder="Ex.: XPTO" required disabled>'.
                                    '</div>'.
                                    '<div class="form-group col-md-6">'.
                                        '<label>Data de Abertura:</label><br>'.
                                        '<input type="date" class="form-control required3" name="txtDataAbertura" id="txtDataAbertura" placeholder="01/01/2000" value='.$value['data_abertura'].' disabled>'.
                                    '</div>'.
                                '</div>'.
                                '<div class="form-row">'.
                                    '<div class="form-group col-md-4">'.
                                        '<label>Porte:</label><br>'.
                                        '<input type="text" class="form-control required3" name="txtPorte" id="txtPorte" placeholder="ME" value='.$value['porte'].' required disabled>'.
                                    '</div>'.
                                    '<div class="form-group col-md-4">'.
                                        '<label>CNPJ:</label><br>'.
                                        '<input type="text" class="form-control required3" name="txtCnpj" id="txtCnpj" placeholder="99.999.999/9999-99" value='.$value['cnpj'].' required disabled>'.
                                    '</div>'.
                                    '<div class="form-group col-md-4">'.
                                        '<label>Situação Cadastral:</label><br>'.
                                        '<select class="custom-select mr-sm-2 required3" onclick="removeSelect()" id="selectSituacao" disabled>'.
                                            '<option id="select_atual">'.$value['situacao_cadastral'].'</option>'.
                                            '<option>Selecione a situação</option>'.
                                            '<option value="Ativa">Ativa</option>'.
                                            '<option value="Suspensa">Suspensa</option>'.
                                        '</select>'.
                                    '</div>'.
                                '</div>'.

                                '<div class="form-row botoes_acao">'.
                                    '<div class="col-">'.
                                        '<i class="fas fa-edit fa-2x" onclick="habilitaEdicaoEmpresa()"></i>'.
                                    '</div>'.
                                    '<div class="col-">'.
                                        '<i class="fas fa-window-close fa-2x" onclick="desabilitaEdicaoEmpresa()"></i>'.
                                    '</div>'.
                                    '<div class="col-">'.
                                        '<i class="fas fa-user-edit fa-2x" id="btn_cadAux"></i>'.
                                        '<i class="fas fa-user-edit fa-2x" id="btn_cad" onclick="alteraCadastroEmpresa()"></i>'.
                                    '</div>'.
                                '</div>'.
                                '<br><br>'.
                            '</form>'.
                        '</div>'.
                    '</div>'.
                '</div>';
        }
        
    }

}


?>