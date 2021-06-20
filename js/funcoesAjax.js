
/* ---------------------------------------------------
    Cadastro de Funcionário
----------------------------------------------------- */

function cadUser() {

    var txtNome = $('#usuario').val();
    var txtdataNasc = $('#dataNasc').val();
    var txtIdade = $('#idade').val();
    var txtCPF = $('#cpf').val();
    var txtCelular = $('#celular').val();
    var txtEmail = $('#email').val();
    var txtSenha = $('#senha').val();


    var inputs = document.getElementsByClassName('required');
    var len = inputs.length;
    var valid = true;
    for (var i = 0; i < len; i++) {        
        if (!inputs[i].value) {
            valid = false;
            inputs[i].style.border = '1px solid';
            inputs[i].style.borderColor = 'red';
        } else {
            inputs[i].style.border = 'none';
        }
    }
    if (valid) {
        $.ajax({
            url: 'funcionario/cadastraUsuario',
            method: 'POST',
            data: {
                name: txtNome,
                dataNasc: txtdataNasc,
                idade: txtIdade,
                cpf: txtCPF,
                celular: txtCelular,
                email: txtEmail,
                senha: txtSenha
            },
            success: function (result) {
                $('#resultadoCadastro').html(result);
            },
            error: function (result) {
                $('#resultadoCadastro').html(result);
            }

        });
    }    

}

/* ---------------------------------------------------
    Pesquisar Funcionário
----------------------------------------------------- */

function pesqUser() {

    var txtNome = $('#txtNome').val();

    /* A instrução abaixo faz a pesquisa do funcionário caso o evento
       'onclick' do botão de pesquisa seja acionado */

    if (txtNome != '') {

        var txtNome = $('#txtNome').val();

        /* A cada nova consulta, a div onde é mostrado o resultado é então atualizado */
        $("#resultadoPesq").load(location.href + " #resultadoPesq");

        $.ajax({
            url: 'funcionario/pesqUsuarioAjax',
            method: 'GET',
            data: { name: txtNome },
            success: function (result) {
                $('#resultadoPesq').html(result);
            },
            error: function () {
                $('#resultadoPesq').html("Nenhum resultado encontrado.");
            }
        });
    }

    /* A instrução abaixo é necessária para submeter a pesquisa de funcionário
       caso haja a submissão do formulário apertando a tecla 'Enter' */

    if (txtNome != '') {

        $('#formPesqUsuario').on('submit', function (event) {
            event.preventDefault();

            var txtNome = $('#txtNome').val();

            /* A cada nova consulta, a div onde é mostrado o resultado é então atualizado */
            $("#resultadoPesq").load(location.href + " #resultadoPesq");

            $.ajax({
                url: 'funcionario/pesqUsuarioAjax',
                method: 'GET',
                data: { name: txtNome },
                success: function (result) {
                    $('#resultadoPesq').html(result);
                },
                error: function () {
                    $('#resultadoPesq').html("Nenhum resultado encontrado.");
                }
            });
        });
    }

}

/* ---------------------------------------------------
    Alterar Funcionário
----------------------------------------------------- */

function alteraCadastro() {

    var txtId = $('#txtId').val();
    var txtNome = $('#txtUsuario').val();
    var txtdataNasc = $('#txtDataNasc').val();
    var txtIdade = $('#txtIdade').val();
    var txtCPF = $('#txtCPF').val();
    var txtCelular = $('#txtCelular').val();
    var txtEmail = $('#txtEmail').val();
    var txtSenha = $('#txtSenha').val();


    var inputs = document.getElementsByClassName('required2');
    var len = inputs.length;
    var valid = true;
    for (var i = 0; i < len; i++) {           
        if (!inputs[i].value) {
            valid = false;
            inputs[i].style.border = '1px solid';
            inputs[i].style.borderColor = 'red';
        } else {
            inputs[i].style.border = 'none';
        }
    }
    if (valid) {
        $.ajax({
            url: 'funcionario/alterarDadosUsuario',
            method: 'POST',
            data: {
                id: txtId,
                nome: txtNome,
                dataNasc: txtdataNasc,
                idade: txtIdade,
                cpf: txtCPF,
                celular: txtCelular,
                email: txtEmail,
                senha: txtSenha
            },
            success: function (result) {
                $('#resultado').html(result);
                //console.log(result);
            },
            error: function (result) {
                $('#resultado').html(result);
                //console.log(result);
            }
        });
    }

}

/* ---------------------------------------------------
    Excluir Funcionário
----------------------------------------------------- */

function excluirUsuario() {

    desabilitaEdicao();

    var txtId = $('#txtId').val();

    bootbox.confirm({
        message: "Deseja excluir este cadastro?",
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result == true) {

                $.ajax({

                    url: 'funcionario/excluirUsuario',
                    method: 'GET',
                    data: {
                        id: txtId
                    },
                    success: function (result) {
                        $('#resultado').html(result);
                    },
                    error: function (result) {
                        $('#resultado').html(result);
                    }
                });
            } else {

                /* Recarrega o formulário com os dados do usuário. Isto para que o 
                   bootbox não se duplique */
                enviaDadosForm(txtId);
            }
        }

    });

}

/* ---------------------------------------------------
    Atualiza <div> dos resultados das pesquisas
----------------------------------------------------- */

function enviaDadosForm(idUser) {

    /* A cada nova consulta, a div onde é mostrado o resultado é então atualizado */
    $("#resultadoPesq").load(location.href + " #resultadoPesq");

    $.ajax({
        url: 'funcionario/carregaDadosUsuario',
        method: 'GET',
        data: {
            id: idUser
        },
        success: function (result) {
            $('#resultadoPesq').html(result);
        },
        error: function () {
            $('#resultadoPesq').html("Não foi possível carregar os dados. Tente novamente.");
        }
    });
}


/* ---------------------------------------------------
    Registra a anotação no DB
----------------------------------------------------- */

function registraAnotacao(idUser) {

    var txtAnotacoes = $('#areaAnotacoes').val();

    $.ajax({
        url: 'anotacoes/registraAnotacao',
        method: 'POST',
        data: {
            id: idUser,
            txtAnotacoes: txtAnotacoes
        },
        success: function (result) {
            carregaAnotacoes(idUser); // faz o refresh na div através do Ajax
            $('#resultadoAnotacoes').html(result);
        },
        error: function () {
            $('#resultadoAnotacoes').html("Não foi possível carregar os dados. Tente novamente.");
        }
    });

}


/* ---------------------------------------------------
    Carrega as anotações na tela / Refresh
----------------------------------------------------- */

function carregaAnotacoes(idUser) {

    /* Não necessariamente devemos usar essa requisição com parâmetro, pois
        o PHP já possui a variável de sessão de quem está logado. */

    $("#resultPesqAnotacoes").load(location.href + " #resultPesqAnotacoes");

    $.ajax({
        url: 'anotacoes/carregaAnotacoes',
        method: 'GET',
        data: {
            id: idUser,
        },
        success: function (result) {
            $('#resultPesqAnotacoes').html(result);
        },
        error: function () {
            $('#resultPesqAnotacoes').html("Não foi possível carregar os dados. Tente novamente.");
        }
    });

}


/* ---------------------------------------------------
    Edita as alterações das anotações
----------------------------------------------------- */

function editarAnotacao(id_anotacao) {

    var txtAnotacoes = $('#areaAnotacoesCarregada' + id_anotacao + '').val();

    $.ajax({
        url: 'anotacoes/editaAnotacoes',
        method: 'PUT',
        data: {
            id: id_anotacao,
            txtAnotacoes: txtAnotacoes
        },
        success: function (result) {
            $('#areaAnotacoesCarregada' + id_anotacao + '').prop('disabled', true);
            $('#resultadoAnotacoes').html(result);
        },
        error: function () {
            $('#resultadoAnotacoes').html("Não foi possível carregar os dados. Tente novamente.");
        }
    });

}

/* ---------------------------------------------------
    Exclui as anotações
----------------------------------------------------- */

function excluirAnotacao(id_anotacao, id_usuario) {

    bootbox.confirm({
        message: "Deseja excluir esta anotação?",
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result == true) {
                $.ajax({
                    url: 'anotacoes/deletaAnotacoes',
                    method: 'DELETE',
                    data: {
                        id: id_anotacao
                    },
                    success: function (result) {

                        /* Subir a tela para o topo (J-query) */

                        $('html, body').animate({ scrollTop: 0 }, 'medium');
                        $('#resultadoAnotacoes').html(result);
                        carregaAnotacoes(id_usuario);
                    },
                    error: function () {
                        $('#resultadoAnotacoes').html("Não foi possível excluir a anotação. Tente novamente.");
                    }
                });

            }
        }

    });

}


/* ---------------------------------------------------
    Cadastro da Empresa
----------------------------------------------------- */

function alteraCadastroEmpresa() {

    var txtNomeEmpresa = $('#txtNomeEmpresa').val();
    var txtDataAbertura = $('#txtDataAbertura').val();
    var txtPorte = $('#txtPorte').val();
    var txtCnpj = $('#txtCnpj').val();
    var selectSituacao = $('#selectSituacao').val(); 
    
    var inputs = document.getElementsByClassName('required3');
    var len = inputs.length;
    var valid = true;
    for (var i = 0; i < len; i++) {           
        if (!inputs[i].value) {
            valid = false;
            inputs[i].style.border = '1px solid';
            inputs[i].style.borderColor = 'red';
        } else {
            inputs[i].style.border = 'none';
        }
    }
    if (valid) {
        $.ajax({
            url: 'empresa/alterarEmpresa',
            method: 'POST',
            data: {
                nome_empresa: txtNomeEmpresa,
                data_abertura: txtDataAbertura,
                porte: txtPorte,
                cnpj: txtCnpj,
                select_situacao: selectSituacao
            },
            success: function (result) {
                $('#resultadoCadastroEmpresa').html(result);
            },
            error: function () {
                $('#resultadoCadastroEmpresa').html("Não foi possível alterar os dados da empresa.");
            }
        });
    }

}

/* ---------------------------------------------------
    Carregar dados da empresa
----------------------------------------------------- */

function carregarDadosEmpresa() {

    $.ajax({
        url: 'empresa/carregaDadosEmpresa',
        method: 'GET',
        success: function (result) {
            $('#div_empresa').html(result);
        },
        error: function (result) {
            $('#div_empresa').html("Não foi possível carregar os dados da empresa.");
        }


    });

}


/* --------------------------------------------------------------
    Função para confirmar o logout
----------------------------------------------------------------- */


function logout() {

    bootbox.confirm({
        message: "Deseja realmente sair?",
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result == true) {
                $.ajax({
                    url: '../../classes/logout',
                    method: 'GET',
                    success: function (result) {
                        window.location.href = 'http://localhost/crud_single_page_application/'
                    },
                    error: function (result) {
                    }
                });                
            } else {

            }
        }

    });
}