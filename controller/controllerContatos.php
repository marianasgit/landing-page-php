<?php

/********************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de contato 
 * Obs: Este arquivo fará a ponte entre a View e a Model
 * 
 * Autor: Mariana
 * Data: 29/03/2022
 * Versão: 1.0
 *******************************************************************/

// Função para solicitar os dados da model e encaminhar a lista de contatos para a view 
function listarContato()
{
    // Import do arquivo que vai buscar os dados 
    require_once('model/db/contato.php');

    // Chama a função que vai buscar os dados no BD
    $dados = selectAllContatos();

    if (!empty($dados))
        return $dados;
    else
        return false;
}