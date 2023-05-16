<?php

use Api\Controller\CorrentistaController; 
use Api\Controller\ContaController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) 
{
    case '/correntista':
        CorrentistaController::listar();
    break;

    case '/correntista/buscar':
        CorrentistaController::buscar();
    break;
    

    case '/correntista/salvar':
        CorrentistaController::salvar();
    break;
    
    case '/correntista/entrar':
        CorrentistaController::entrar();
    break;
    
    case '/conta/pix/enviar':
        ContaController::enviar();
    break;
    
    case '/conta/pix/receber':
        ContaController::receber();   
    break;
    
    case '/conta/extrato':
        ContaController::extrato();   
    break;

    default:
        http_response_code(403);
    break;
}


