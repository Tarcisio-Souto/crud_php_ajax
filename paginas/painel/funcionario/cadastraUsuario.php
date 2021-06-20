<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

    if ($_POST) {

        $nome = $_POST['name'];
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
            //echo '<script>document.getElementById("inicio").style.display = "none"; document.getElementById("cadastro").style.display = "block";</script>';
            echo Funcionario::retornaErros();
        } else {
            $query = Conexao::conecta()->prepare('INSERT INTO `pessoas` (nome, dataNasc, idade, cpf, celular, email, senha) VALUES (?,?,?,?,?,?,?)');
            $query->execute(array(Funcionario::getNome($nome), Funcionario::getDataNasc($dataNasc), Funcionario::getIdade($idade), Funcionario::getCpf($cpf), Funcionario::getCelular($celular), Funcionario::getEmail($email), $senha));

            if ($query->rowCount() > 0) {
                echo '<div class="cadSucesso">Usuário cadastrado com sucesso!</div>'.
                    '<script>$("#formCadastroUsuario").each(function() {'.
                        'this.reset();'.
                    '});'.
                    'setTimeout(function(){'. 
                        'var msg = document.getElementsByClassName("cadSucesso");'.
                        'while(msg.length > 0){'.
                            'msg[0].parentNode.removeChild(msg[0]);'.
                        '}'.
                    '}, 2000);'.
                '</script>';
            } else {
                echo '<script>alert("Não foi possível cadastrar usuário. Contacte o administrador do site.");</script>';
            }
        }
        
    }
