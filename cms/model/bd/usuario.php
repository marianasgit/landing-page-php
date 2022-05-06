<?php

/*********************************************************************
 * Objetivo: arquivo responsavel por manipular os dados dentro do BD(insert, select, update, delete)
 * Autor: Mariana
 * Data: 26/04/2022
 * Versão: 1.0
 *********************************************************************/

 // Import do arquivo que estabelece a conexão com o BD
 require_once('conexaoMySql.php');

 $statusResposta = (bool) false;

 // Função para fazer o insert no BD
function insertUsuario($dadosUsuario)
{
    $statusResposta = false;

     // Abre a conexão com o BD
     $conexao = conexaoMySql();

     // Monta o script para enviar para o BD
     $sql = "insert into tblusuarios 
                (nome, 
                login, 
                senha) 
            values 
                ('".$dadosUsuario['nome']."',
                 '".$dadosUsuario['login']."',
                 '".$dadosUsuario['senha']."');";

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

function selectAllUsuarios ()
{
    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Script para listar todos os dados do BD
    $sql = 'select * from tblusuarios';

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
                "id"    => $rsDados['idusuario'],
                "nome"  => $rsDados['nome'],
                "login"  => $rsDados['login'],
                "senha"  => $rsDados['senha']
            );
            $cont++;
        }

        // Solicita o fechamento da conexão com o BD
        fecharConexaoMySql($conexao);

        return $arrayDados;
    }
}

function deleteUsuario($id)
{
    // Abre conexão com o BD
    $conexao = conexaoMySql();

    // Script para deletar um registro no BD
    $sql = 'delete from tblusuarios where idusuario ='.$id;

    // Valida se o script está correto 
    if (mysqli_query($conexao, $sql))
    {      
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;
    
}

function updateUsuario($dadosUsuario)
{
    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Monta o script para enviar para o BD
    $sql = "update tblusuarios set 
                nome     = '" . $dadosUsuario['nome'] . "',
                login     = '" . $dadosUsuario['login'] . "',
                senha     = '" . $dadosUsuario['senha'] . "'
            where idusuario = ".$dadosUsuario['id'];

    // Valida se o script esta correto
    if (mysqli_query($conexao, $sql))
    {
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;

    } else
        // Solicita o fechamento da conexão
        fecharConexaoMySql($conexao);       
        
    return $statusResposta;    
}

function selectByIdUsuario($id)
{
    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Script para listar todos os dados do BD
    $sql = 'select * from tblusuarios where idusuario = '.$id;

    // Executa o script sql no BD e guarda o retorno dos dados se houver
    $result = mysqli_query($conexao, $sql);

    // Valida se o BD retorna registros
    if ($result)
    {
        // Convertendo dados do BD em array
        if ($rsDados = mysqli_fetch_assoc($result))
        {
            // Cria um array com os dados do BD
            $arrayDados = array(
                "id" => $rsDados['idusuario'],
                "nome" => $rsDados['nome'],
                "login" => $rsDados['login'],
            );
        }
    }

    fecharConexaoMySql($conexao);
    return $arrayDados;
}

?>