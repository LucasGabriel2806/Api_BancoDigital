<?php

namespace App\Controller;

/**
 * Definimos aqui que nossa classe precisa incluir uma classe de outro subnamespace
 * do projeto, no caso a classe PessoaModel do subnamespace Model
 */
use App\Model\ContaModel;


/**
 * Classes Controller são responsáveis por processar as requisições do usuário.
 * Isso significa que toda vez que um usuário chama uma rota, um método (função)
 * de uma classe Controller é chamado.
 * O método poderá devolver uma View (fazendo um include), acessar uma Model (para
 * buscar algo no banco de dados), redirecionar o usuário de rota, ou mesmo,
 * chamar outra Controller.
 */
class ContaController extends Controller
{
    public static function abrir()
    {

    }

    public static function fechar()
    {
        
    }

    public static function extrato()
    {
        
    }





    /**
     * Os métodos index serão usados para devolver uma View.
     * Para saber mais sobre métodos estáticos, leia: https://www.php.net/manual/pt_BR/language.oop5.static.php
     */
    public static function index()
    {      
        //$model = new ContaModel(); // Instância da Model
        //$model->getAllRows(); // Obtendo todos os registros, abastecendo a propriedade $rows da model.

        /**
         * O método getResponseAsJSON devolve uma string JSON formatada e pronta para ser
         * consumida pela chamada.
         * Recebe como parâmetro o element PHP a ser convertido para JSON, neste caso um
         * array de objetos
         */
        //parent::getResponseAsJSON($model->rows);
    }
}