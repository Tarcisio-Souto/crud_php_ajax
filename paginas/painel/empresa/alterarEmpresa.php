<?php

include($_SERVER['DOCUMENT_ROOT'] . '/crud_single_page_application/config.php');

$metodo = $_SERVER['REQUEST_METHOD'];

if ($metodo === 'POST') {

    $nome_empresarial = $_POST['nome_empresa'];
    $cnpj = $_POST['cnpj'];
    $data_abertura = $_POST['data_abertura'];
    $select_situacao = $_POST['select_situacao'];
    $porte = $_POST['porte'];

    Empresa::setNomeEmpresarial($nome_empresarial);
    Empresa::setCnpj($cnpj);
    Empresa::setDataAbertura($data_abertura);
    Empresa::setPorte($porte);
    Empresa::setSituacaoCadastral($select_situacao);

    if (Empresa::setCnpj($cnpj) == false) {
        echo Empresa::retornaErros();
    } else {

        $conn = Conexao::conecta()->prepare('SELECT * FROM `cadastro_empresa`');
        $conn->execute();

        if ($conn->rowCount() > 0) {

            foreach ($conn->fetchAll() as $value) {

                if ($nome_empresarial == $value['nome_empresarial'] && $cnpj == $value['cnpj'] && $data_abertura == $value['data_abertura'] && $select_situacao == $value['situacao_cadastral'] && $porte == $value['porte']) {
                    echo '<div class="divAlerta">Nenhum dado foi alterado</div>' .
                        '<script>' .
                        'setTimeout(function(){' .
                        'var msg = document.getElementsByClassName("divAlerta");' .
                        'while(msg.length > 0){' .
                        'msg[0].parentNode.removeChild(msg[0]);' .
                        '}' .
                        '}, 2000);' .
                        '</script>';
                } else {

                    $conn = Conexao::conecta()->prepare('UPDATE `cadastro_empresa` SET `nome_empresarial` = ?, `cnpj` = ?, `data_abertura` = ?, `situacao_cadastral` = ?, `porte` = ? WHERE `id_empresa` = 1');
                    $conn->execute(array(Empresa::getNomeEmpresarial($nome_empresarial), Empresa::getCnpj($cnpj), Empresa::getData_abertura($data_abertura), Empresa::getSituacaoCadastral($select_situacao), Empresa::getPorte($porte)));

                    echo '<div class="cadSucesso">Empresa registrada com sucesso!</div>' .
                        '<script>'.                        
                        'desabilitaEdicaoEmpresa02();'.
                        'setTimeout(function(){' .
                        'var msg = document.getElementsByClassName("cadSucesso");' .
                        'while(msg.length > 0){' .
                        'msg[0].parentNode.removeChild(msg[0]);'.
                        '$.ajax({' .
                            'url: "empresa/carregaDadosEmpresa",' .
                            'method: "GET",' .
                            'success: function (result) {' .
                            '$("#div_empresa").html(result);' .
                            '},' .
                            'error: function (result) {' .
                            '$("#div_empresa").html("Não foi possível carregar os dados da empresa.");' .
                            '}' .
                            '});'.
                        '}'.
                        '}, 2000);' .
                        '</script>';
                }
            }
        } else {
            echo '<script>alert("Não foi possível cadastrar usuário. Contacte o administrador do site.");</script>';
        }
    }
}
