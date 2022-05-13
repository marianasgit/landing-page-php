<?php

/*********************************************************************
 * Objetivo: arquivo responsavel por manipular os dados dentro do BD(insert, select, update, delete)
 * Autor: Mariana
 * Data: 12/04/2022
 * Versão: 1.0
 *********************************************************************/

 // Import do arquivo que estabelece a conexão com o BD
 require_once('conexaoMySql.php');

 $statusResposta = (bool) false;

 // Função para fazer o insert no BD
 function insertCategoria($dadosCategoria)
 {

    $statusResposta = false; 

     // Abre a conexão com o BD
     $conexao = conexaoMySql();

     // Monta o script para enviar para o BD
     $sql = "insert into tblcategorias
                    (nome)
            values
                    ('".$dadosCategoria['nome']."');";

    // Validação para verificar se o script sql está correto
    if (mysqli_query($conexao, $sql))
    {
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;

    }        
    // Solicita o fechamento da conexão
    fecharConexaoMySql($conexao);  
    return $statusResposta;             
 }

 function deleteCategoria($id)
 {
     // Abre conexão com o BD
     $conexao = conexaoMySql();

     // Script para deletar um registro no BD
     $sql = 'delete from tblcategorias where idcategoria = ' . $id;

     // Valida se o script está correto, sem erro de sintaxe e o executa
     if (mysqli_query($conexao, $sql))
     {
         // Valida se o BD teve sucesso na execucao do script
         if (mysqli_affected_rows($conexao))
            $statusResposta = true; 
     }

     fecharConexaoMySql($conexao);
     return $statusResposta;
 }

function updateCategoria($dadosCategoria)
{
    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Monta o script para enviar para o BD
    $sql = "update tblcategorias set 
                nome = '".$dadosCategoria['nome']."' 
            where idcategoria = ".$dadosCategoria['id']; 

    // Valida se o script sql está correto
    if (mysqli_query($conexao, $sql)) 
    {
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;

    } else 
        // Solicita o fechamento da conexão
        fecharConexaoMySql($conexao);
    
    return $statusResposta;    
}

 function selectAllCategorias()
 {
     // Abre a conexão com o BD
     $conexao = conexaoMySql();

     // Script para listar todos os dados do BD
     $sql = 'select * from tblcategorias order by nome';

     // Executa o script sql e guarda o retorno se houver
     $result = mysqli_query($conexao, $sql);

     // Valida se o BD retorna registros
     if ($result)
     {
         $cont = 0;

         while ($rsDados = mysqli_fetch_assoc($result))
         {
             //Cria um array com os dados do BD
             $arrayDados[$cont] = array(
                 "id"    => $rsDados['idcategoria'],
                 "nome"  => $rsDados['nome']
             );
             $cont++;
         }
 
         // Solicita o fechamento da conexão com o BD
         fecharConexaoMySql($conexao);

         return $arrayDados;
     }
 }

 function selectByIdCategoria($id)
 {
     // Abre a conexão com o BD
     $conexao = conexaoMySql();

     // Script para listar todos os dados do banco de dados
     $sql = 'select * from tblcategorias where idcategoria = ' . $id;

     // Executa o script sql no BD e guarda o retorno dos dados se houver
     $result = mysqli_query($conexao, $sql);

     // Valida se o BD retorna registros
     if ($result) 
     {
         // Convertendo dados do BD em array
         if ($rsDados = mysqli_fetch_assoc($result))
         {
             // Cria um array com os dados do BD
             $arrayDados  = array(
                 "id"   => $rsDados['idcategoria'],
                 "nome" => $rsDados['nome'],
             );
         }

     }

     fecharConexaoMySql($conexao);
     return $arrayDados;
 }
?>