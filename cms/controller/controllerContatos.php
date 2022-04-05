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
    require_once('./model/bd/contato.php');

    // Chama a função que vai buscar os dados no BD
    $dados = selectAllContatos();

    if (!empty($dados))
        return $dados;
    else
        return false;
}

function excluirContato($id) 
{
    // Validação do id
    if ($id != 0 && !empty($id) && is_numeric($id))
    {
        // Importando arquivo de contato
        require_once('model/bd/contato.php');

        // Chama a função da model e valida o retorno
        if (deleteContato($id))
            return true;
        else 
            return array(
                'idErro' => 3,
                'message' => 'O banco de dados não pode excluir o registro'
            );    
    } else
        return array(
            'idErro' => 4,
            'message' => 'Não é possível excluir um registro sem informar um id'
        );
}