<?php

namespace App\Controller;

use App\Model\CorrentistaModel;
use Exception;

class CorrentistaController extends Controller
{
    /**
     * Responsável por processar o login do Correntista.
     */
    public static function login()
    {
        try
        {
            // Transformando os dados da entrada enviada do app em
            // JSON para um objeto em PHP.
            // Obtendo os dados enviados por json via C#.
            // file_get_contents: lê um arquivo em uma string.
            // php://input: é um fluxo somente leitura que permite 
            // ler dados brutos do corpo da solicitação.
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            /**
             * Realizando o login com os dados digitados na interface do App.
             * 
             * Exemplo de saída que poderá ser vista no Console do Visual Studio 2022:
             * 
             * {"rows":null,"id":"6","nome":"Giovani","email":"giovani@teste.com",
             * "cpf":"123456789","data_nascimento":"2005-02-08T00:00:00","senha":"123"}
             */
            parent::getResponseAsJSON($model->getByCpfAndSenha($data->Cpf, $data->Senha)); 

        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }  
    }

    /**
     * Preenche um Model para que seja enviado ao banco de dados para salvar.
     */
    public static function salvar()
    {
        try
        {
            /**
             * Obtendo os dados enviados por json via C#
             */
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            // $model->nome = $data->nome;

            // Copiando os valores de $data para $model dinâmicamente
            foreach (get_object_vars($data) as $key => $value) 
            {
                $prop_letra_minuscula = strtolower($key);

                $model->$prop_letra_minuscula = $value;
            }

            /**
             * Salvando o novo correntista e definindo a saída.
             * Exemplo de saída que poderá ser vista no Console do Visual Studio 2022:
             * {"rows":null,"id":"6","nome":"Giovani","email":"giovani@teste.com","cpf":"123456789","data_nascimento":"2005-02-08T00:00:00","senha":"123"}
             */
            parent::getResponseAsJSON($model->save()); 

        } catch(Exception $e) {
            
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }   
    }
}