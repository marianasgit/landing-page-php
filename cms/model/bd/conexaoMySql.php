<?php

/*********************************************************************
 * Objetivo: arquivo para criar a conexão com o banco de dados MySQL
 * Autor: Mariana
 * Data: 29/03/2022
 * Versão: 1.0
 *********************************************************************/

// Constantes para estabelecer a conexao com o banco de dados (local do banco, usuario, senha e database),
const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = 'bcd127';
const DATABASE = 'dbcoffeeshop';

$resultado = conexaoMySql();

// Abre a conexao com o banco de dados MySql
function conexaoMySql()
{
    $conexao = array();

    // Se a conexao for estabelecida com o banco de dados, vamos ter um array de dados sobre a conexao
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    // Validaçao para verificar se a conexao foi realizada com sucesso
    if ($conexao)
        return $conexao;
    else
        return false;
}

function fecharConexaoMySql($conexao)
{
    mysqli_close($conexao);
}