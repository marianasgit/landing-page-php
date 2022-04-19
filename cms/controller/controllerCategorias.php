<?php
/********************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de categoria 
 * Obs: Este arquivo fará a ponte entre a View e a Model
 * 
 * Autor: Mariana
 * Data: 12/04/2022
 * Versão: 1.0
 *******************************************************************/

 // Função para receber dados da View e encaminhar para a model (Inserir)
function inserirCategoria($dadosCategoria)
{
    // Vaçidação para verificar se o objeto está vazio
    if (!empty($dadosCategoria)) 
    {
        // Validação de caixa vazia para o elemento nome que é obrigatório no BD
        if (!empty($dadosCategoria['txtNome']))
        {
            // Criação do array de dados que será encaminhado para a model para inserir no BD
            $arrayDados = array (
                "nome" => $dadosCategoria['txtNome'],
            );

            // Import do arquivo de modelagem para manipular o BD
            require_once('model/bd/categoria.php');

            // Chama a função que fará o insert no banco de dados (função que está na model)
            if (insertCategoria($arrayDados))
                return true;
            else    
                return array ('idErro' => 1, 'message' => 'Não foi possível inserir os dados no banco de dados');

        } else  
            return array (
                'idErro' => 2,
                'message' => 'Campo obrigatório não preenchido!'
            );
    }
}

function excluirCategoria($id)
{
    // Validação para verificar se o id contém um número válido
    if ($id !== 0 && !empty($id) && is_numeric($id))
    {
        // Import do arquivo de categoria
        require_once('model/bd/categoria.php');

        // Chama a função da model e valida se o retorno foi verdadeiro ou falso
        if (deleteCategoria($id))
            return true;
        else
            return array(
                'idErro' => 3,
                'message' => 'O banco não pode excluir o registro.'
            );    
    
    } else
        return array(
            'idErro' => 4,
            'message' => 'Não é possível excluir um registro sem informar um Id válido'
        );
}

function buscarCategoria($id)
{
    // Validação para verificar se o id contém um número válido
    if ($id !== 0 && !empty($id) && is_numeric($id))
    {
        // Import do arquivo na model que vai buscar no BD
        require_once('model/bd/categoria.php');

        // Chama a função que vai buscar no BD
        $dados = selectByIdCategoria($id);

        // Valida se existem dados para serem devolvidos
        if (!empty($dados))
            return $dados;
        else 
            return false;

    } else 
        return array (
            'idErro' => 4,
            'message' => 'Não é possível buscar um registro sem informar um Id válido'
        );

}

function atualizarCategoria($dadosCategoria, $id)
{
    // Validação de objeto vazio
    if (!empty($dadosCategoria))
    {
        // Validação de caixa vazia de elementos obrigatórios
        if (!empty($dadosCategoria['txtNome']))
        {
            // Validação de id válido
            if (!empty($id) && $id != 0 && is_numeric($id))
            {
                // Array para encaminhar os dados para a model inserir no BD
                $arrayDados = array(
                    "id"   => $id,
                    "nome" => $dadosCategoria['txtNome']
                );

                // Import do arquivo de modelagem para manipular o BD
                require_once('model/bd/categoria.php');

                // Chama a função que fará o insert no BD
                if (updateCategoria($arrayDados))
                    return true;

                else
                    return array('idErro' => 1, 'message' => 'Não foi possível atualizar os dados no banco de dados');    
            
            } else 
            {
                return array('idErro' => 4, 'message' => 'Não é possivel editar um registro sem um Id válido');
            }
        
        } else 
        {
            return array('idErro' => 2, 'message' => 'Campo obrigatório não preenchido');
        }
    }
}

function listarCategoria()
{
    // Import do arquivo que vai buscar os dados
    require_once('model/bd/categoria.php');

    // Chama a função que vai buscar os dados no BD
    $dados = selectAllCategorias();

    if (!empty($dados))
        return $dados;
    else    
        return false;    
}

?>