<?php

/*********************************************************************
 * Objetivo: arquivo responsavel por manipular os dados dentro do BD(insert, select, update, delete)
 * Autor: Mariana
 * Data: 05/04/2022
 * Versão: 1.0
 *********************************************************************/

// Import do arquivo que estabelece a conexão com o BD
require_once('conexaoMySql.php');

$statusResposta = (bool) false;

// Função para realizar o insert no BD
function insertContato($dadosContato)
{
    // Abre a conexao com o BD
    $conexao = conexaoMySql();
    
}

// Função para listar todos os contatos no BD
function selectAllContatos()
{

    require_once('conexaoMySql.php');
    // Abre a conexao com o banco de dados
    $conexao = conexaoMySql();

    // Script para listar todos os dados do banco de dados
    $sql = 'select * from tblcontatos order by idcontato desc';

    // Executa o script sql no BD e guarda o retorno dos dados se houver
    $result = mysqli_query($conexao, $sql);
    
    if ($result) {

        $cont = 0;
        // Essa conversão irá transformar os dados do banco em array

        while ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados[$cont] = array(

                    "id"         =>   $rsDados['idcontato'],
                    "nome"       =>   $rsDados['nome'],
                    "email"      =>   $rsDados['email'],
                    "obs"        =>   $rsDados['obs']
            );
            $cont++;
        }

        // Solicita o fechamento da conexao com o BD
        fecharConexaoMySql($conexao);

        return $arrayDados;
    }

}



function deleteContato($id)
{

    require_once('conexaoMySql.php');
    // Abre a conexao com o BD
    $conexao = conexaoMySql();

    $sql = 'delete from tblcontatos where idcontato = ' .$id;

    // Validação de script e execução
    if (mysqli_query($conexao, $sql)) 
    {
        // Valida a conexao com o BD
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    fecharConexaoMySql($conexao);
    return $statusResposta;
}