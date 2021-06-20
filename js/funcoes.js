/* Solução em Javascript para impedir o reenvio de formulário */

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

$(document).ready(function () {

    abreItensMenu();
    $("#cpf").mask("000.000.000-00");
    $('#celular').mask('(00) 00000-0000');

    $('#txtCnpj').mask('00.000.000/0000-00');


    /* Essa função foi necessária p/ que a pesquisa do funcionário seja
       possível através da tecla 'Enter' já que não há 'submit' */

    $(document).keypress(function (e) {

        if (e.which == 13) {
            pesqUser();
        }

    });


    /* ---------------------------------------------------
        Manipulando as anotações
    ----------------------------------------------------- */

    /* Abre o display de anotações */

    $(function () {
        $('.fa-caret-down').click(function () {
            var subAnotacoes = $('#subAnotacoes');
            subAnotacoes.slideToggle();
        });
    });

    $('.fecharAnotacao').css('display', 'none');
    $('.fa-check-square').css('display', 'none');

    $('.fa-plus-circle').on('click', function () {
        $('#areaAnotacoes').css('display', 'block');
        $('.fa-plus-circle').css('display', 'none');
        $('.fecharAnotacao').css('display', 'block');
        $('.fa-check-square').css('display', 'block');
    });

    $('.fecharAnotacao').on('click', function () {
        $('#areaAnotacoes').css('display', 'none');
        $('.fa-plus-circle').css('display', 'block');
        $('.addAnotacao').css('display', 'none');
        $('.fecharAnotacao').css('display', 'none');
        $('#areaAnotacoes').val('');
    });

    $('.addAnotacao').on('click', function () {
        $('#areaAnotacoes').val('');
        $('#areaAnotacoes').css('display', 'none');
        $('.fecharAnotacao').css('display', 'none');
        $('.addAnotacao').css('display', 'none');
        $('.fa-plus-circle').css('display', 'block');
    });


});

/* ---------------------------------------------------
        Função para abrir a edição da anotação
----------------------------------------------------- */

function abreFechaEdicaoAnotacao(id_anotacao) {

    $('.abrirAnotacaoCarregada' + id_anotacao).on('click', function () {
        $('#areaAnotacoesCarregada' + id_anotacao).prop('disabled', false);
    });

    $('#fecharAnotacaoCarregada' + id_anotacao).on('click', function () {
        $('#areaAnotacoesCarregada' + id_anotacao).prop('disabled', true);
    });
}


function abreItensMenu() {

    $('#cadUsuario').on('click', function () {
        $('#cadastro').css('display', 'block');
        $('#inicio').css('display', 'none');
        $('#pesquisarUsuario').css('display', 'none');
        $('#cabecalho_empresa').css('display', 'none');
        $('#div_empresa').css('display', 'none');
        $('#sobre').css('display', 'none');
    });

    $('#mostrar_inicio').on('click', function () {
        $('#inicio').css('display', 'block');
        $('#cadastro').css('display', 'none');
        $('#pesquisarUsuario').css('display', 'none');
        $('#cabecalho_empresa').css('display', 'none');
        $('#div_empresa').css('display', 'none');
        $('#sobre').css('display', 'none');
    });

    $('#pesqUsuario').on('click', function () {
        $('#pesquisarUsuario').css('display', 'block');
        $('#cadastro').css('display', 'none');
        $('#inicio').css('display', 'none');
        $('#cabecalho_empresa').css('display', 'none');
        $('#div_empresa').css('display', 'none');
        $('#sobre').css('display', 'none');
    });

    $('#pag_empresa').on('click', function () {
        $('#cabecalho_empresa').css('display', 'block');
        $('#div_empresa').css('display', 'block');
        $('#inicio').css('display', 'none');
        $('#cadastro').css('display', 'none');
        $('#pesquisarUsuario').css('display', 'none');
        $('#sobre').css('display', 'none');
    });

    $('#mostrarSobre').on('click', function () {
        $('#sobre').css('display', 'block');
        $('#cabecalho_empresa').css('display', 'none');
        $('#div_empresa').css('display', 'none');
        $('#inicio').css('display', 'none');
        $('#cadastro').css('display', 'none');
        $('#pesquisarUsuario').css('display', 'none');
    });

}


function habilitaEdicao() {
    $("input").prop('disabled', false);
    $("#txtCPF").mask("000.000.000-00");
    $('#txtCelular').mask('(00) 00000-0000');

    /* Troca os botões de registros */

    $('#btn_cadAuxUsuario').css('display', 'none');
    $('#btn_cadUsuario').css('display', 'block');

}

function desabilitaEdicao() {
    $("input[id='txtUsuario'],[id='txtDataNasc'],[id='txtIdade'],[id='txtCPF'],[id='txtCelular'],[id='txtEmail'],[id='txtSenha']").prop('disabled', true);
    $('#formCadastroUsuario2').each(function () {
        this.reset();
    });
}

function habilitaEdicaoEmpresa() {
    $("input").prop('disabled', false);
    $("select").prop('disabled', false);
    $('#cnpj').mask('00.000.000/0000-00');

    /* Troca os botões de registros */

    $('#btn_cadAux').css('display', 'none');
    $('#btn_cad').css('display', 'block');

}

function desabilitaEdicaoEmpresa() {
    $("input[id='txtNomeEmpresa'],[id='txtDataAbertura'],[id='txtPorte'],[id='txtCnpj'],[id='selectSituacao']").prop('disabled', true);
    $('#formCadastroEmpresa').each(function () {
        this.reset();
    });
}

function desabilitaEdicaoEmpresa02() {
    $("input[id='txtNomeEmpresa'],[id='txtDataAbertura'],[id='txtPorte'],[id='txtCnpj'],[id='selectSituacao']").prop('disabled', true);
}


/* --------------------------------------------------------------
    Função para remover o select atual da situação da empresa
----------------------------------------------------------------- */

function removeSelect() {

    $('#select_atual').css('display', 'none');


}


