<?php

/********************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de contato 
 * Obs: Este arquivo fará a ponte entre a View e a Model
 * 
 * Autor: Mariana
 * Data: 26/04/2022
 * Versão: 1.0
 *******************************************************************/

//função para receber dados da View e encaminhar para a model (Inserir)
function inserirUsuario($dadosUsuario)
{
    //validacao para verificar se o objeto esta vazio
    if (!empty($dadosUsuario)) 
    {
        //validacao de caixa vazia dos elementos: nome, login e senha pois são obrigatorias no BD
        if (!empty($dadosUsuario['txtNome']) && !empty($dadosUsuario['txtLogin']) && !empty($dadosUsuario['txtSenha']))
        {
            $senha = $dadosUsuario['txtSenha'];
            $cryptoSenha = crypt($senha); 

            //criacao do array de dados que sera encaminhado para a model para inserir no BD
            $arrayDados = array(
                "nome"   => $dadosUsuario['txtNome'],
                "login"  => $dadosUsuario['txtLogin'],
                "senha"  => $cryptoSenha,
            );

            // Import do arquivo de modelagem para manipular o BD
            require_once('model/bd/usuario.php');

            // CHama a função que fará o insert no banco de dados (função que está na model)
            if (insertUsuario($arrayDados))
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

function listarUsuario ()
{
    // Import do arquivo que vai buscar os dados
    require_once('model/bd/usuario.php');

    // Chama a função que vai buscar os dados no BD
    $dados = selectAllUsuarios();

    if (!empty($dados))
        return $dados;
    else    
        return false;
}

function excluirUsuario($id)
{
    // Validação para verificar se o id contém um número válido
    if ($id !== 0 && !empty($id) && is_numeric($id))
    {
        // Import do arquivo de usuario
        require_once('model/bd/usuario.php');

        // Chama a função da model e valida se o retorno foi verdadeiro ou falso
        if (deleteUsuario($id))
            return true;
        else 
            return array(
                'idErro' => 3,
                'message' => 'O banco não pode excluir o registro.'
            );

    } else 
        return array(
            'idErro' => 4,
            'message' => 'Não é possível excluir um regisrto sem informar um id válido'
        );
}

function buscarUsuario($id)
{
    if ($id !== 0 && !empty($id) && is_numeric($id))
    {
        require_once('model/bd/usuario.php');

        $dados = selectByIdUsuario($id);

        if(!empty($dados))
            return $dados;
        else    
            return false;

    } else
        return array (
            'idErro' => 4,
            'message' => 'Não é possível buscar um registro sem informar um Id válido'
        );
}

function atualizarUsuario($dadosUsuario, $id)
{
    if (!empty($dadosUsuario))
    {
        if(!empty($dadosUsuario['txtNome']) && !empty($dadosUsuario['txtLogin']) && !empty($dadosUsuario['txtSenha']))
        {
            $senha = $dadosUsuario['txtSenha'];
            $cryptoSenha = crypt($senha); 

            if (!empty($id) && $id !== 0 && is_numeric($id))
            {
                $arrayDados = array(
                    "id"    => $id,
                    "nome"  => $dadosUsuario['txtNome'],
                    "login" => $dadosUsuario['txtLogin'],
                    "senha" => $cryptoSenha,
                );

                require_once('model/bd/usuario.php');

                if (updateUsuario($arrayDados))
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

?>