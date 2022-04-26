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
function inserirUsuario ($dadosUsuario)
{
    //validacao para verificar se o objeto esta vazio
    if (!empty($dadosContato)) 
    {
        //validacao de caixa vazia dos elementos: nome, login e senha pois são obrigatorias no BD
        if (!empty($dadosUsuario['txtNome']) && !empty($dadosUsuario['txtLogin']) && !empty($dadosUsuario['txtSenha']))
        {
            //criacao do array de dados que sera encaminhado para a model para inserir no BD
            $arrayDados = array(
                "nome"   => $dadosUsuario['txtNome'],
                "login"  => $dadosUsuario['txtLogin'],
                "senha"  => $dadosUsuario['txtSenha'],
            );

            // Import do arquivo de modelagem para manipular o BD
            require_once('model/bd/usuario.php');

            // CHama a função que fará o insert no banco de dados (função que está na model)
            if (inserirUsuario($arrayDados))
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

?>