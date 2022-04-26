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

    } else 
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

?>