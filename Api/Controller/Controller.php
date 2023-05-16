<?php

/**
 * Definição do namespace da controller. Veja que temos o namespace chamado "App"
 * e dentro do namespace App temos o subnamespace "Controller". Também é importante
 * observar que eles são o mesmo caminho de diretórios e usamos barra invertida
 * para definir os namespaces.
 * Leia mais sobre namespaces => http://www.diogomatheus.com.br/blog/php/entendendo-namespaces-no-php/
 * Namespaces no manual => https://www.php.net/manual/pt_BR/language.namespaces.rationale.php
 */
namespace Api\Controller;

use Exception;

/**
 * Classe abstrata Controller para armazenar métodos comuns às classes Controller.
 * Manual do PHP => https://www.php.net/manual/pt_BR/language.oop5.abstract.php
 * Leia mais sobre abstração: https://www.devmedia.com.br/trabalhando-com-abstracao-em-php/28351
 */
abstract class Controller 
{
    /**
     * Grava a mensagem de erro de uma exceção em um arquivo de texto.
     */
    protected static function LogError(Exception $e)
    {
        $f = fopen("erros.txt", "w");
        fwrite($f, $e->getTraceAsString());
    }


    /**
     * Converte um dado para JSON
     */
    protected static function getResponseAsJSON($data)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($data));
    }

    /**
     * Dá uma resposta do servidor como JSON
     */
    protected static function setResponseAsJSON($data, $request_status = true)
    {
        $response = array('response_data' => $data, 'response_successful' => $request_status);

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($response));
    }


    /**
     * 
     */
    protected static function getExceptionAsJSON(Exception $e)
    {
        $exception = [
            'message' => $e->getMessage(), 
            'code' => $e->getCode(), 
            'file' => $e->getFile(), 
            'line' => $e->getLine(), 
            'traceAsString' => $e->getTraceAsString(), 
            'previous' => $e->getPrevious()
        ];
        
        http_response_code(400);

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($exception));
    }


    /**
     * 
     */
    protected static function isGet()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'GET')
            throw new Exception("O método de requisição deve ser GET");
    }


    /**
     * 
     */
    protected static function isPost()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST')
            throw new Exception("O método de requisição deve ser POST");
    }


    /**
     * 
     */
    protected static function getIntFromUrl($var_get, $var_name = null) : int
    {
        self::isGet();

        if(!empty($var_get))
                return (int) $var_get;
        else
            throw new Exception("Variável $var_name não identificada.");
    }

    
    /**
     * 
     */
    protected static function getStringFromUrl($var_get, $var_name = null) : string
    {
        self::isGet();

        if(!empty($var_get))
                return (string) $var_get;
        else
            throw new Exception("Variável $var_name não identificada.");
    }
}