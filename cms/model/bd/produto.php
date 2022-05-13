<?php

/*********************************************************************
 * Objetivo: arquivo responsavel por manipular os dados dentro do BD(insert, select, update, delete)
 * Autor: Mariana
 * Data: 13/05/2022
 * Versão: 1.0
 *********************************************************************/

require_once('conexaoMysql.php');

$statusResposta = (bool) false;

function insertProduto($dadosProduto)
{
    $statusResposta = false;

    //abre a conexao com o BD
    $conexao = conexaoMysql();

    //monta o script para enviar para o BD
    $sql = "insert into tblprodutos
                (nome,
                descricao,
                preco,
                destaque,
                percentual_promocao,
                imagem,
                idcategoria)
            values
                ('" . $dadosProduto['nome'] . "',
                 '" . $dadosProduto['descricao'] . "',
                 '" . $dadosProduto['preco'] . "',
                 '" . $dadosProduto['destaque'] . "',
                 '" . $dadosProduto['percentual_promocao'] . "',
                 '" . $dadosProduto['imagem'] . "',
                 '".$dadosProduto['idcategoria']."');";

    //executa o script no BD

    //validacao para verificar se o script sql esta correto
    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao))
            $statusResposta = true;  // Podemos definir a variável criando em qualquer ligar

    }

    // Solicita o fechamento da conexão
    fecharConexaoMySql($conexao);

    return $statusResposta;
}

// function updateProduto($dadosProduto)
// {
//      //abre a conexao com o BD
//      $conexao = conexaoMysql();

//      //monta o script para enviar para o BD
//      $sql = "update tblprodutos set
//                  nome                = '" . $dadosProduto['nome'] . "',
//                  descricao           = '" . $dadosProduto['descricao'] . "',
//                  preco               = '" . $dadosProduto['preco'] . "',
//                  destaque            = '" . $dadosProduto['destaque'] . "',
//                  percentual_promocao = '" . $dadosProduto['percentual_promocao'] . "',
//                  imagem              = '" .$dadosProduto['foto'] ."',
//                  idcategoria         = '" .$dadosProduto['idestado']."'
//             where idproduto          = "  .$dadosProduto['id'];
 
//      //executa o script no BD
 
//      //validacao para verificar se o script sql esta correto
//      if (mysqli_query($conexao, $sql)) {
 
//          if (mysqli_affected_rows($conexao))
 
//              $statusReposta = true;  // Podemos definir a variável criando em qualquer ligar
 
//      } else
 
//          // Solicita o fechamento da conexão
//          fecharConexaoMySql($conexao);
 
//      return $statusReposta;
// }

// function deleteProduto($id)
// {
//     // Abre a conexao com o BD
//     $conexao = conexaoMysql();

//     // Script para deletar um registro so BD
//     $sql = 'delete from tblprodutos where idproduto = ' . $id; // para numeros inteiros nao e preciso concatenacao com aspas e pontos

//     // Valida se o script está correto, sem erro de sitaxe e o executa
//     if (mysqli_query($conexao, $sql)) {
//         // Valida se o BD teve sucesso na conexao do script
//         if (mysqli_affected_rows($conexao))
//             $statusResposta = true;
//     }

//     // Fecha a conexao com o BD
//     fecharConexaoMySql($conexao);
//     return $statusResposta;
// }

function selectAllProdutos()
{
    //abre a conexao com o banco de dados
    $conexao = conexaoMysql();

    //script para listar todos os dados do banco de dados 
    $sql = 'select * from tblprodutos order by idproduto desc';

    //executa o script sql no BD e guarda o retorno dos dados se houver
    $result = mysqli_query($conexao, $sql);                                  //quando mandados um script para o banco do tipo insert, delete, etc.
    // o script nao tera retorno, ao contrario do select que precisa retornal algo

    //valida se o BD retorna registros
    if ($result) {

        $cont = 0;
        //nesta repeticao estamos convertendo os dados do banco de daos do BD em um array ($rsDados),
        // alem de o proprio while conseguir gerenciar a quantidade de vezes que dveria ser feita a repeticao
        while ($rsDados = mysqli_fetch_assoc($result)) {
            //cria um array com os dados do banco de dados 
            $arrayDados[$cont] = array(
                "id"                  =>   $rsDados['idproduto'],
                "nome"                =>   $rsDados['nome'],
                "descricao"           =>   $rsDados['descricao'],
                "preco"               =>   $rsDados['preco'],
                "destaque"            =>   $rsDados['destaque'],
                "percentual_promocao" =>   $rsDados['percentual_promocao'],
                "imagem"              =>   $rsDados['imagem'],
                "idcategoria"         =>   $rsDados['idcategoria']
            );
            $cont++;
        }

        // Solicita o fechamento da conexão com o BD. Ação obrigatória (abrir e fechar) 
        fecharConexaoMySql($conexao);

        if(isset($arrayDados))
            return $arrayDados;
        else    
            return false;    
    }
}

// function selectByIdProduto($id)
// {
//     //abre a conexao com o banco de dados
//     $conexao = conexaoMysql();

//     //script para listar todos os dados do banco de dados 
//     $sql = 'select * from tblprodutos where idproduto = ' . $id;

//     //executa o script sql no BD e guarda o retorno dos dados se houver
//     $result = mysqli_query($conexao, $sql);                                  //quando mandados um script para o banco do tipo insert, delete, etc.
//     // o script nao tera retorno, ao contrario do select que precisa retornal algo

//     //valida se o BD retorna registros
//     if ($result) {

//         //nesta repeticao estamos convertendo os dados do banco de daos do BD em um array ($rsDados),
//         // alem de o proprio while conseguir gerenciar a quantidade de vezes que dveria ser feita a repeticao
//         if ($rsDados = mysqli_fetch_assoc($result)) {

//             //cria um array com os dados do banco de dados 
//             $arrayDados      =    array(
//                 "id"                  =>   $rsDados['idproduto'],
//                 "nome"                =>   $rsDados['nome'],
//                 "descricao"           =>   $rsDados['descricao'],
//                 "preco"               =>   $rsDados['preco'],
//                 "destaque"            =>   $rsDados['destaque'],
//                 "percentual_promocao" =>   $rsDados['percentual_promocao'],
//                 "imagem"              =>   $rsDados['imagem'],
//                 "idcategoria"         =>   $rsDados['idcategoria']
//             );
//         }

//     }    
//         // Solicita o fechamento da conexão com o BD. Ação obrigatória (abrir e fechar) 
//         fecharConexaoMySql($conexao);

//         return $arrayDados;
// }

?>