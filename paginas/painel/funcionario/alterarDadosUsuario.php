<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

if ($_POST) {

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $dataNasc = $_POST['dataNasc'];
    $idade = $_POST['idade'];
    $cpf = $_POST['cpf'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    //$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    Funcionario::setNome($nome);
    Funcionario::setDataNasc($dataNasc);
    Funcionario::setIdade($idade);
    Funcionario::setCpf($cpf);
    Funcionario::setCelular($celular);
    Funcionario::setEmail($email);
    Funcionario::setSenha($_POST['senha']);

    if (Funcionario::setCelular($celular) == false || Funcionario::setSenha($_POST['senha']) == false) {
        echo Funcionario::retornaErros();
    } else {
        $sqlSelect = Conexao::conecta()->prepare('SELECT * FROM `pessoas` WHERE id = ?');
        $sqlSelect->execute(array($id));

        if ($sqlSelect->rowCount() > 0) {

            foreach ($sqlSelect->fetchAll() as $value) {

                if ($nome == $value['nome'] && $dataNasc == $value['dataNasc'] && $idade == $value['idade'] && $cpf == $value['cpf'] && $celular == $value['celular'] && $email == $value['email'] && $senha == $value['senha']) {
                    echo '<div class="divAlerta">Nenhum dado foi alterado</div>' .
                        '<script>' .
                        'setTimeout(function(){' .
                        'var msg = document.getElementsByClassName("divAlerta");' .
                        'while(msg.length > 0){' .
                        'msg[0].parentNode.removeChild(msg[0]);' .
                        '}' .
                        '}, 2000);' .
                        'enviaDadosForm('.$id.');'.
                        '</script>';
                } else {
                    $query = Conexao::conecta()->prepare('UPDATE `pessoas` SET nome = ?, dataNasc = ?, idade = ?, cpf = ?, celular = ?, email = ?, senha = ? WHERE id = ?');
                    $query->execute(array(Funcionario::getNome($nome), Funcionario::getDataNasc($dataNasc), Funcionario::getIdade($idade), Funcionario::getCpf($cpf), Funcionario::getCelular($celular), Funcionario::getEmail($email), $senha, $id));

                    if ($query->rowCount() > 0) {

                        echo '<script> $.ajax({' .
                            'url: "funcionario/carregaDadosUsuario",' .
                            'method: "GET",' .
                            'data: {' .
                            'id: ' . $id . '' .
                            '},' .
                            'success: function(result) {' .
                            '$("#resultadoPesq").html(result);'.
                            '},' .
                            'error: function() {' .
                            '$("#resultadoPesq").html("Não foi possível carregar os dados. Tente novamente.");' .
                            '}' .
                            '});' .
                            '</script>' .
                            '<div class="cadAltSucesso">Cadastro alterado com sucesso</div>' .
                            '<script>' .
                            'setTimeout(function(){' .
                            'var msg = document.getElementsByClassName("cadAltSucesso");' .
                            'while(msg.length > 0){' .
                            'msg[0].parentNode.removeChild(msg[0]);' .
                            '}' .
                            '}, 2000);' .
                            '</script>';
                    } else {
                        echo '<script>alert("Não foi possível cadastrar usuário. Contacte o administrador do site.");</script>';
                    }
                }
            }
        }else {
            echo '<script>alert("Não foi possível cadastrar usuário. Contacte o administrador do site.");</script>';
        }
    }
}
