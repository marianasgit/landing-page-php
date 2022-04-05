<?php

/*****************************************************************************
 * Objetivo: Arquivo de rota para seguimentar as ações encaminhadas pela View
 *           (dados de um form, listagem de dados, ação de excluir ou atualizar)
 *            Esse arquivo será responsável por encaminhar as solicitações para 
 *            a controller  
 * 
 * Autor: Mariana
 * Data: 05/04/2022
 * Versão: 1.0
 *******************************************/

$action = (string) null;
$component = (string) null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') 
{
    // Recebendo os dados via URL
    $component = strtoupper($_GET['component']);
    $action = strtoupper($_GET['action']);

    // Validar quem está solicitando para o router
    switch ($component) 
    {
        case 'CONTATOS':

            // Import da controller contato
            require_once('controller/controllerContatos.php');

            if ($action == 'DELETAR')
            {
                // Recebendo o registro
                $idcontato = $_GET['id'];

                // Chamando a função de excluir na controller
                $resposta = excluirContato($idcontato);

                if (is_bool($resposta)) 
                {
                    if ($resposta) 
                    {
                        echo("<script>alert('Registro excluído com sucesso!');window.location.href = 'listaDeContatos.php';</script>");

                    } elseif (is_array($resposta)) 
                    {
                        echo ("<script>alert('".$resposta['message']."');window.history.back();</script>");
                    }
                }
            }
        break;
    }
}


?>