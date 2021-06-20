<?php

include($_SERVER['DOCUMENT_ROOT']. '/crud_single_page_application/config.php');

$nome = $_GET['name'];

if ($_GET) {
    $sql = Conexao::conecta()->prepare("SELECT * FROM `pessoas` WHERE nome like '%" . $nome . "%'");
    $sql->execute();
    if ($sql->rowCount() > 0) {
        
        foreach($sql->fetchAll() as $value){
            
            list($ano, $mes, $dia) = explode('-', $value['dataNasc']);
            $data = $dia.'/'.$mes.'/'.$ano;

            echo '<div class="table-responsive-sm"><table class="table">'.
            '<thead class="corThead">'.
              '<tr align="center">'.
                '<th scope="col">Nº</th>'.
                '<th scope="col">Nome</th>'.
                '<th scope="col">Data de Nascimento</th>'.
                '<th scope="col">Idade</th>'.
                '<th scope="col">Visualizar</th>'.
              '</tr>'.
            '</thead>'.
            '<tbody>'.
              '<tr class="tabelaPesquisa" align="center">'.
                '<th scope="row">' .$value['id']. '</th>'.
                '<td>' .$value['nome']. '</td>'.
                '<td>' .$data. '</td>'.
                '<td>' .$value['idade']. '</td>'.
                '<td>'.
                    '<a href="javascript:enviaDadosForm('.$value['id'].');"><i class="fas fa-eye fa-2x"></i></a></form>'.
                '</td>'.
              '</tr>'.
            '</tbody>'.
          '</table></div>';
        }
                
    }else{
      echo 'Nenhum usuário encontrado =/';
    }
}

?>