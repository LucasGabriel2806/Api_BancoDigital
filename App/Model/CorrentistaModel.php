<?php

namespace App\Model;

use App\DAO\CorrentistaDAO;

/**
 * A camada model é responsável por transportar os dados da Controller até a DAO e vice-versa.
 * Também é atribuído a Model a validação dos dados da View e controle de acesso aos métodos
 * da DAO.
 */
class CorrentistaModel extends Model
{
    /**
     * 
     */
    public $id, $nome, $cpf, $data_nasc, $senha;
    
    /**
     * 
     */
    public function save()
    {
        if($this->id == null)
            return (new CorrentistaDAO())->insert($this);
        else
            return (new CorrentistaDAO())->update($this);
    }

    /**
     * 
     */
    public function getAllRows(string $query = null)
    {
        $dao = new CorrentistaDAO();

        $this->rows = ($query == null) ? $dao->select() : $dao->search($query);
    }

    /**
     * 
     */
    public function delete(int $id)
    {
        (new CorrentistaDAO())->delete($id);
    }
}