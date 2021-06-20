<?php

include($_SERVER['DOCUMENT_ROOT'] . '/crud_single_page_application/config.php');

if (Painel::sessao() == false) {
    header('Location: ' . INCLUDE_PATH_BEGIN);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>CRUD Com Ajax</title>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="<?php echo INCLUDE_PATH_STYLE_PAINEL; ?>">


    <!-- Jquery / Jquery Mask -->
    <script src="http://localhost//crud_single_page_application/js/jquery.3.5.1.js"></script>
    <script src="http://localhost//crud_single_page_application/js/jquery.mask.min.js"></script>

    <!-- Bootstrap CSS CDN -->
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Scrollbar Custom CSS -->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Bootbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js" integrity="sha512-8NOmlkzoskIBni4iy5onHC57Mndt17mZgWkYJvxe5jwBJu3spYIRSjTkYJ9OLNS9Min+bsSqbDfGaoejWxyFiw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js" integrity="sha512-BmJnAn7RE1O2+6GspbWDCKNArksSjhQnl8tKwy2+VkCJKInHfn37MxyyrPz8MvqYJxy3KINjcg97tIiUMGl6Uw==" crossorigin="anonymous"></script>

    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/3d7779fa7f.js" crossorigin="anonymous"></script>

    <!-- Funções AJAX -->
    <script src="http://localhost//crud_single_page_application/js/funcoesAjax.js"></script>

    <!-- Funções JS -->
    <script src="http://localhost//crud_single_page_application/js/funcoes.js"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <div id="close">
                    <i class="fas fa-window-close"></i>
                </div>
                <div class="img-usuario">
                    <i class="fas fa-user"></i>
                </div>
                <p>Bem vindo, <?php echo $_SESSION['usuario']; ?>!</p>
            </div>
            <ul class="list-unstyled components">
                <p><i class="fas fa-tools"></i>Ferramentas</p>
                <hr>
                <li>
                    <a id="mostrar_inicio" href="javascript:abreItensMenu();"><i class="fas fa-home"></i>Início</a>
                </li>
                <li>
                    <a id="pag_empresa" href="javascript:carregarDadosEmpresa();"><i class="fas fa-building"></i>Empresa</a>
                </li>
                <li>
                    <a href="#funcionarioSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-user-tie"></i>Funcionário</a>
                    <ul class="collapse list-unstyled" id="funcionarioSubMenu">
                        <li>
                            <a id="cadUsuario" href="javascript:abreItensMenu();"><i class="fas fa-user-plus"></i>Cadastrar</a>
                        </li>
                        <li>
                            <a id="pesqUsuario" href="javascript:abreItensMenu();"><i class="fas fa-search"></i>Consultar</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#relatoriosSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-file-alt"></i>Relatórios</a>
                    <ul class="collapse list-unstyled" id="relatoriosSubMenu">
                        <li>
                            <a id="#" href="#"><i class="fas fa-user-tie"></i>Funcionários</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="mostrarSobre" href="javascript:abreItensMenu();"><i class="fas fa-info-circle"></i>Sobre</a>
                </li>
                <li>
                    <!--<a href="<?php echo INCLUDE_PATH_MAIN ?>?logout"><i class="fas fa-sign-out-alt"></i>Sair</a>-->
                    <a href="javascript:logout();"><i class="fas fa-sign-out-alt"></i>Sair</a>
                </li>  
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <!-- Início Home -->

            <div id="inicio">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button type="button" class="btn btn-info sidebarCollapse">
                            <i class="fas fa-align-left"></i>
                            <span>Menu</span>
                        </button>
                        <h2><i class="fas fa-home"></i>Início</h2>
                    </div>
                </nav>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="anotacoes">
                            <div id="resultadoAnotacoes"></div>
                            <p><i class="fas fa-caret-down" onclick="carregaAnotacoes(<?php echo $_SESSION['id'] ?>);"></i>Anotações</p>
                            <div class="row" id="subAnotacoes">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="formAnotacoes">
                                                <textarea name="areaAnotacoes" id="areaAnotacoes"></textarea>
                                                <i class="fas fa-plus-circle fa-2x"></i>
                                                <i class="fas fa-check-square addAnotacao" onclick="registraAnotacao(<?php echo $_SESSION['id'] ?>)"></i>
                                                <i class="fas fa-window-close fecharAnotacao"></i>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Resultado da Pesquisa das Anotações -->
                                            <div id="resultPesqAnotacoes"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Div que carrega os dados da empresa -->

            <div id="cabecalho_empresa">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button type="button" class="btn btn-info sidebarCollapse">
                            <i class="fas fa-align-left"></i>
                            <span>Menu</span>
                        </button>
                        <h2><i class="fas fa-building"></i>Empresa</h2>
                    </div>
                </nav>
            </div>

            <!-- Div que carrega os dados da empresa -->

            <div id="div_empresa">
                
            </div>


            <!-- Início Cadastro Funcionário -->

            <div id="cadastro">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button type="button" class="btn btn-info sidebarCollapse">
                            <i class="fas fa-align-left"></i>
                            <span>Menu</span>
                        </button>
                        <h2><i class="fas fa-user-plus add-user-icon"></i>Cadastro de Funcionário</h2>
                    </div>
                </nav>

                <div id="resultadoCadastro"></div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="formCadastroUsuario" id="formCadastroUsuario">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Usuário:</label><br>
                                        <input type="text" class="form-control required" name="txtUsuario" id="usuario" placeholder="Ex.: Tarcisio dos Santos Souto" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Data de Nascimento:</label><br>
                                        <input type="date" class="form-control required" name="txtDataNasc" id="dataNasc" placeholder="01/01/2000" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Idade:</label><br>
                                        <input type="text" class="form-control required" name="txtIdade" id="idade" placeholder="27" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>CPF:</label><br>
                                        <input type="text" class="form-control required" name="txtCPF" id="cpf" placeholder="000.000.000-00" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Celular:</label><br>
                                        <input type="text" class="form-control required" name="txtCelular" id="celular" placeholder="(27) 99999-9999" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>E-mail:</label><br>
                                        <input type="email" class="form-control required" name="txtEmail" id="email" placeholder="tarcisio@tarcisio.com" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Senha:</label>
                                        <input type="password" class="form-control required" name="txtSenha" id="senha" placeholder="Senha" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8"></div>
                                    <div class="form-group col-md-4" align="right">
                                        <i class="btnCadastrar fas fa-user-plus fa-2x" form="formCadastroUsuario" onclick="cadUser()"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br><br><br>
            </div>

            <!-- Fim Cadastro -->

            <!-- Início Pesquisa Funcionário -->

            <div id="pesquisarUsuario">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button type="button" class="btn btn-info sidebarCollapse">
                            <i class="fas fa-align-left"></i>
                            <span>Menu</span>
                        </button>
                        <h2><i class="fas fa-search pesq-func-icon"></i>Pesquisar Funcionário</h2>
                    </div>
                </nav>

                <div class="container conteudo-pesquisar">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <form id="formPesqUsuario">
                                <div class="input-group">
                                    <input class="form-control" id="txtNome" type="text" placeholder="Ex.: Tarcisio dos Santos Souto" aria-label="Search" style="border-right: none;" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text" style="background-color: #FFF">
                                            <i class="btnPesquisar fas fa-search" onclick="pesqUser()"></i>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <hr>
                    </hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" id="resultado"></div>
                        </div>
                        <div class="row dadosPesquisa">
                            <div class="col-md-12" id="resultadoPesq"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fim Pesquisa Usuário -->

            <!-- Início Sobre -->

            <div id="sobre">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <button type="button" class="btn btn-info sidebarCollapse">
                            <i class="fas fa-align-left"></i>
                            <span>Menu</span>
                        </button>
                        <h2><i class="fas fa-info-circle info-icon"></i>Sobre</h2>
                    </div>
                </nav>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row quem-sou">
                                <div class="col-md-12">
                                    <p>Um pouco sobre mim...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row descricao-quem-sou">
                        <div class="col-md-12">
                            <img src="../../imagens/eu_mesmo.jpeg" alt="Eu mesmo..." class='img-fluid minha-foto'>
                            <p>Meu nome é Tarcisio, tenho 28 anos e moro na capital do Espírito Santo. Atualmente, ocupo um cargo público
                                estatutário na Secretaria Municipal de Educação da Prefeitura de Cariacica, cujo qual tomei posse após aprovação em concurso
                                público.</p>

                            <p>Meu interesse por ciência e tecnologia existe desde o início da adolescência, pois sempre gostei de consertar e criar coisas.
                                No segundo semestre de 2015 ingressei no Instituto Federal do Espírito Santo para cursar o Técnico Em Informática, o qual
                                norteou qual seria a carreira que iria seguir.</p>

                            <p>Busquei aproveitar ao máximo tudo o que aprendi durante o ensino técnico, o que me fez ganhar interesse por diversos
                                segmentos dentro da TI. Confesso que no primeiro momento o que me cativou foram as telecomunicações com sua engenharia
                                e protocolos, mesmo com a presença massiva da programação durante todo o curso. O projeto que fiz para apresentar na
                                disciplina de conclusão do curso foi um jogo 2D com quatro fases utilizando a engine Unity 3D, e o estudo e desenvolvimento
                                intenso me trouxeram de vez para o universo da programação.</p>

                            <p>No ano seguinte, após o término do curso em 2017, fui contratado como estagiário de uma empresa onde fui promovido antes mesmo de completar 
                                um mês de estágio. Ainda naquele ano, iniciei o bacharelado de Sistemas de Informação também
                                no Instituto Federal do Espírito Santo. Foi um período difícil, pois o bacharelado era no turno matutino, e conciliar emprego
                                e estudos naquele momento era impossível.</p>

                            <p>Com a nomeação do concurso que fiz, tive que optar pelo trabalho por motivo de força maior, mesmo sendo "Ifano" de coração, então desde 2018 atuo na
                                administração pública.</p>

                            <p>Em 2019 consegui uma bolsa de estudos integral para cursar Sistemas de Informação na UCV - Universidade Católica de Vitória
                                através da nota do ENEM, e atualmente estou finalizando o 5º período. O bacharelado está me mostrando que as competências de um Analista de Sistemas vão além da programação (embora seja
                                o que eu ame fazer juntamente com a soluções embasadas em estatísticas e dados), pois
                                há elementos que compõem e agregam valor à profissão e que se mostram imprescindíveis no dia a dia das pessoas e organizações.</p>
                        </div>
                    </div>
                    <div class="row topicos-quem-sou">
                        <div class="col-md-4">
                            <label>O que consigo usar?</label>
                            <ul>
                                <li>HTML</li>
                                <li>CSS</li>
                                <li>Bootstrap</li>
                                <li>Javascript</li>
                                <li>JQuery</li>
                                <li>Ajax</li>
                                <li>PHP</li>
                                <li>Python</li>
                                <li>Java</li>
                                <li>C#</li>
                                <li>Laravel</li>
                                <li>Node.js</li>
                                <li>MySQL</li>
                                <li>Arquitetura MVC</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <label>O que estou aprendendo?</label>
                            <ul>
                                <li>Vue.js</li>
                                <li>API REST</li>
                                <li>Flask</li>
                                <li>Estatística</li>                                
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <label>Quais as metas?</label>
                            <ul>
                                <li>Desenvolvedor de Sistemas</li>
                                <li>Iniciação Científica</li>
                                <li>Proficiência Em Estatística</li>
                                <li>Mestrado
                                    <ul>
                                        <li>Inteligência Artificial - IFES Serra</li>
                                    </ul>
                                </li>
                                <p></p>
                                <li>Lecionar</li>
                                <li>Pesquisar</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br><br><br>
            </div>



        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $(window).resize(function() {
                if (window.matchMedia("(min-width: 561px)").matches) {
                    $('#sidebar').css('width', '250px');
                }

                if (window.matchMedia("(max-width: 560px)").matches) {
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                }

            });


            $('.sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');

                if (window.matchMedia("(max-width: 560px)").matches) {
                    $('#sidebar').css('width', '100%');
                }

            });


            $('#close').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');

                if (window.matchMedia("(max-width: 560px)").matches) {
                    $('#sidebar').css('width', '250px');
                }

                clicou = false;

            });


        });
    </script>
</body>

</html>