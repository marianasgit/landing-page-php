<?php

/********************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de contato 
 * Obs: Este arquivo fará a ponte entre a View e a Model
 * 
 * Autor: Mariana
 * Data: 29/03/2022
 * Versão: 1.0
 *******************************************************************/

// Função para receber dados da View e encaminhar para a model (inserir)
function inserirContato($dadosContato)
{
    // Validação para verificar se o objeto está vazio
    if (!empty($dadosContato)) 
    {
        // Validação de caixa vazia dos elementos: nome, email e mensagem pois são obrigatórias no BD
        if (!empty($dadosContato['txtNome']) && !empty($dadosContato['txtEmail']) && !empty($dadosContato['txtObs']))
        {
            // Criação do array de dados que sera encaminhado para a model para inserir no BD
            // é importante criar esse array conforme a necessidade de manipulação do BD
            // obs: criar as chaves do array conforme os nomes dos atributos do banco de dados
            $arrayDados = array(
                "nome" => $dadosContato['txtNome'],
                "email" => $dadosContato['txtEmail'],
                "obs" => $dadosContato['txtObs'],
            );

            // Import do arquivo de modelagem para manipular o BD
            require_once('model/bd/contato.php');

            // Chama a função que fará o insert no BD (essa função está na model)
            if (inserirContato($arrayDados))
                return true;
            else
                return array('idErro' => 1, 'message' => 'Não foi possível inserir os dados no banco de dados');

        } else 
            return array(
                'idErro' => 2,
                'message' => 'Por favor, preencha todos os campos'
            );
    }
}


// Função para solicitar os dados da model e encaminhar a lista de contatos para a view 
function listarContato()
{
    // Import do arquivo que vai buscar os dados 
    require_once('model/bd/contato.php');

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