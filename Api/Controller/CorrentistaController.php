<?php

namespace Api\Controller;

use Api\Model\CorrentistaModel;
use Exception;


/**
 * 
 */
class CorrentistaController extends Controller
{
    /**
     * 
     */
    public static function salvar() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            $model->id = $json_obj->Id;
            $model->nome = $json_obj->Nome;
            $model->cpf = $json_obj->Cpf;
            $model->data_nasc = $json_obj->Data_Nasc;
            $model->senha = $json_obj->Senha;

            parent::getResponseAsJSON($model->save());
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    // 
    public static function entrar() : void
    {
        
    }

    /**
     * 
     */
    public static function listar() : void
    {
        try
        {
            $model = new CorrentistaModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    /**
     * 
     */
    public static function buscar() : void
    {
        try
        {
            $model = new CorrentistaModel();
            
            $q = json_decode(file_get_contents('php://input'));
            
            //fwrite(fopen("dados.json", "w"), file_get_contents('php://input'));
            
            $model->getAllRows($q);

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    /**
     * Remove uma pessoa do banco de dados.
     */
    public static function deletar() : void
    {
        try 
        {
            $id = json_decode(file_get_contents('php://input'));
            
            (new CorrentistaModel())->delete( (int) $id);

        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }
}