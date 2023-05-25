<?php

use Api\Controller\
{
    CorrentistaController,
    ContaController,
    TransacaoController,
};

// Para saber mais sobre a função parse_url: https://www.php.net/manual/pt_BR/function.parse-url.php
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Para saber mais estrutura switch, leia: https://www.php.net/manual/pt_BR/control-structures.switch.php
switch ($url) 
{
    case '/exportar':
        $return_var = NULL;
        $output = NULL;
        $command = 'C:/"Program Files"/MySQL/"MySQL Server 8.0"/bin/mysqldump -uroot -petecjau -P3307 -hlocalhost db_bancodigital > C:/Dev/file.sql';
        exec($command, $output, $exit_code);

        var_dump($exit_code);

        /*$h=fopen("C:/Dev/file.sql", "w+");
        fputs($h, $output);
        fclose($h);*/

        echo "deu certo.";
    break;



    /**
     * Método: POST
     * URL: https://bancodigital.tiago.blog.br/correntista/salvar
     * URL Local: http://0.0.0.0:8000/correntista/salvar
     */
    case '/correntista/salvar':
        CorrentistaController::salvar();
    break;

    /**
     * Método: POST
     * URL: https://bancodigital.tiago.blog.br/correntista/entrar
     * URL Local: http://0.0.0.0:8000/correntista/salvar
     */
    case '/correntista/entrar':
        CorrentistaController::login();
    break;

    /**
     * Método: POST
     * URL: https://bancodigital.tiago.blog.br/cliente/salvar
     * URL Local: http://0.0.0.0:8000/cliente/salvar
     */
    // Exemplo de Acesso: https://bancodigital.tiago.blog.br/conta/abrir
    case '/conta/abrir':
        ContaController::abrir();
    break;

    /**
     * Método: POST
     * URL: https://bancodigital.tiago.blog.br/cliente/salvar
     * URL Local: http://0.0.0.0:8000/cliente/salvar
     */
    // Exemplo de Acesso: https://bancodigital.tiago.blog.br/conta/fechar
    case '/conta/fechar':
        ContaController::fechar();
    break;

    /**
     * Método: POST
     * URL: https://bancodigital.tiago.blog.br/cliente/salvar
     * URL Local: http://0.0.0.0:8000/cliente/salvar
     */
    // Exemplo de Acesso: https://bancodigital.tiago.blog.br/conta/extrato
    case '/conta/extrato':
        ContaController::extrato();
    break;

    /**
     * Método: POST
     * URL: https://bancodigital.tiago.blog.br/cliente/salvar
     * URL Local: http://0.0.0.0:8000/cliente/salvar
     */
    // Exemplo de Acesso: https://bancodigital.tiago.blog.br/pix/receber
    case '/transacao/pix/receber':
        TransacaoController::receberPix();
    break;

    /**
     * Método: POST
     * URL: https://bancodigital.tiago.blog.br/cliente/salvar
     * URL Local: http://0.0.0.0:8000/cliente/salvar
     */
    // Exemplo de Acesso: https://bancodigital.tiago.blog.br/pix/enviar
    case '/transacao/pix/enviar':
        TransacaoController::enviarPix();
    break;

    /**
     * Método: POST
     * URL: https://bancodigital.tiago.blog.br/cliente/salvar
     * URL Local: http://0.0.0.0:8000/cliente/salvar
     */
    default:
        header('HTTP/1.0 403 Forbidden');
    break;
}

