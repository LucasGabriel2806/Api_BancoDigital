<?php

namespace App\Model;

use App\DAO\ContaDAO;
use App\DAO\CorrentistaDAO;

/**
 * A camada model é responsável por transportar os dados da Controller até a DAO e vice-versa.
 * Também é atribuído a Model a validação dos dados da View e controle de acesso aos métodos
 * da DAO.
 */
class CorrentistaModel extends Model
{
    /**
     * Declaração das propriedades conforme campos da tabela no banco de dados.
     * para saber mais sobre Propriedades de Classe, leia: https://www.php.net/manual/pt_BR/language.oop5.properties.php
     */
    public $id, $nome, $email, $cpf, $data_nascimento, $senha;
    public $rows_contas; // array de objetos ContaModel

    /**
     * Declaração do método save que chamará a DAO para gravar no banco de dados
     * o model preenchido.
     */
    public function save() : ?CorrentistaModel
    {
        $dao_correntista = new CorrentistaDAO();
        
        $model_preenchido = $dao_correntista->save($this);

        // Se o insert do correntista deu certo
        // vamos inserir sua conta corrente e poupança
        if($model_preenchido->id != null)
        {
            $dao_conta = new ContaDAO();

            // Abrindo a conta corrente
            $conta_corrente = new ContaModel();
            $conta_corrente->id_correntista = $model_preenchido->id;
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'C';
            $conta_corrente = $dao_conta->insert($conta_corrente);

            $model_preenchido->rows_contas[] = $conta_corrente;

            // Abrindo a conta poupança
            $conta_poupanca = new ContaModel();
            $conta_poupanca->id_correntista = $model_preenchido->id;
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca->tipo = 'P';
            $conta_poupanca = $dao_conta->insert($conta_poupanca);

            $model_preenchido->rows_contas[] = $conta_poupanca;
        }

        return $model_preenchido;    
    }


    /**
     * Método que encapsula a chamada a DAO e que abastecerá a propriedade rows;
     * Esse método é importante pois como a model é "vista" na View a propriedade
     * $rows será acessada e possibilitará listar os registros vindos do banco de dados
     */
    public function getByCpfAndSenha($cpf, $senha) : CorrentistaModel
    {      
        return (new CorrentistaDAO())->selectByCpfAndSenha($cpf, $senha);
    }
}