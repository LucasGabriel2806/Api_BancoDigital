<?php

/**
 * Definição do namespace da controller. Veja que temos o namespace chamado "App"
 * e dentro do namespace App temos o subnamespace "Controller". Também é importante
 * observar que eles são o mesmo caminho de diretórios e usamos barra invertida
 * para definir os namespaces.
 * Leia mais sobre namespaces => http://www.diogomatheus.com.br/blog/php/entendendo-namespaces-no-php/
 * Namespaces no manual => https://www.php.net/manual/pt_BR/language.namespaces.rationale.php
 */
namespace App\Controller;

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
        // Abre para edição e o retorno(resource: conexão com sistemas externos, 
        // como arquivo) é armazenado:
        $file = fopen("erros.txt", "w");
        // Escreve no arquivo $file a getTraceAsString
        fwrite($file, $e->getTraceAsString());
        // fecha 
        fclose($file);
    }


    /**
     * Define a saída de uma exceção como JSON.
     */
    protected static function getExceptionAsJSON(Exception $e)
    {
        //Array com infos sobre a exceção
        $exception = [
            'message' => $e->getMessage(), 
            'code' => $e->getCode(), 
            'file' => $e->getFile(), 
            'line' => $e->getLine(), 
            'traceAsString' => $e->getTraceAsString(), 
            'previous' => $e->getPrevious()
        ];
        
        //bad request(erro)
        http_response_code(400);

        /**
         * Essas são chamadas de instruções de cabeçalho HTTP.
         * 
         * 1)
         * define a política de controle de acesso 
         * de origem, permitindo que qualquer origem (representada por *) 
         * acesse os recursos deste servidor. Isso é usado para permitir solicitações 
         * cross-origin (CORS) a partir de qualquer lugar.
         * 
         * 2)
         * Define o tipo de conteúdo da resposta como JSON e especifica o 
         * conjunto de caracteres UTF-8 para codificação.
         * 
         * 3)
         * Controla como os caches devem lidar com a resposta. 
         * "no-cache" indica que os caches não devem 
         * armazenar uma cópia em cache da resposta, e "must-revalidate" 
         * significa que os caches devem revalidar a resposta com o servidor 
         * antes de usá-la novamente.
         * 
         * 4)
         * Define uma data de expiração para a resposta. a data é definida 
         * como 26 de julho de 1997, que indica que a resposta não deve ser 
         * armazenada em cache e deve ser considerada como expirada.
         * 
         * 5)
         * é um cabeçalho de controle de cache que indica que a resposta 
         * pode ser armazenada em cache publicamente (ou seja, por 
         * qualquer cache intermediário, como servidores proxy).
         */
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        // Transforma infos da exceção em Json.
        exit(json_encode($exception));
    }

    /**
     * Converte um dado para JSON
     */
    protected static function getResponseAsJSON($data)
    {
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

        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($response));
    }
}