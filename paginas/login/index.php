<?php
 
 include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

    if(Painel::sessao() == true){
        header('Location: '.INCLUDE_PATH_MAIN);
    }

?>
<!DOCTYPE html>
<html>
    <title>Cadastro Orientado a Objeto</title>
    <head>
        <link rel="stylesheet" href='<?php echo INCLUDE_PATH_STYLE; ?>'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        


        <script type="text/javascript">

            /* Solução em Javascript para impedir o reenvio de formulário */

            if (window.history.replaceState) {
		        window.history.replaceState( null, null, window.location.href );
		    }

        </script>        

    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 box-login">
                    
                    <?php
                        
                        if(isset($_POST['btnEntrar'])){
                            $usuario = $_POST['txtUsuario'];
                            $senha = md5($_POST['txtSenha']);

                            $query = Conexao::conecta()->prepare('SELECT * FROM `pessoas` WHERE nome = ?');
                            $query->execute(array($usuario));
                            
                            if($query->rowCount() == 1){
                                
                                foreach($query->fetchAll() as $value){
                                    $_SESSION['id'] = $value['id'];
                                    $md5 = $value['senha'];
                                }

                                if($senha == $md5){
                                    $_SESSION['login'] = true;                                
                                    $_SESSION['usuario'] = $usuario;
                                    $_SESSION['senha'] = $senha;
                                    header('Location: '.INCLUDE_PATH_MAIN);
                                    die();
                                }else{
                                    echo '<p class="msgErro">Senha incorreta</p>';
                                    ?>
                                    <script>
                                    
                                    /* Função que remove o elemento da mensagem de erro após 2s */

                                    setTimeout(function(){ 
                                        var msg = document.getElementsByClassName("msgErro");
                                        while(msg.length > 0){
                                            msg[0].parentNode.removeChild(msg[0]);
                                        }
                                    }, 2000);                                    
                                    
                                </script>   
                                <?php                            
                                }                                
                            }else{
                                echo '<p class="msgErro">Usuário não cadastrado</p>';
                                ?>
                                <script>
                                    
                                    /* Função que remove o elemento da mensagem de erro após 2s */

                                    setTimeout(function(){ 
                                        var msg = document.getElementsByClassName("msgErro");
                                        while(msg.length > 0){
                                            msg[0].parentNode.removeChild(msg[0]);
                                        }
                                    }, 2000);                                    
                                    
                                </script>
                            <?php    
                            }
                        }
                    ?>

                    <form method="POST" class="formLogin">
                        <h1>Login</h1>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Usuário:</label><br>
                                <input type="text" class="form-control" name="txtUsuario" placeholder="Usuário" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Senha:</label>
                                <input type="password" class="form-control" name="txtSenha" placeholder="Senha" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <button type="submit" name="btnEntrar" class="btn btn-primary">Entrar</button>
                            </div>
                        </div>                         
                    </form>
                </div>
                <div class="col-md-4"></div>   
            </div>
        </div>
    </body>
</html>