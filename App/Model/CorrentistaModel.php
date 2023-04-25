<?php

namespace App\Model;
use App\DAO\CorrentistaDAO;

class CorrentistaModel
{

    public $id, $nome, $cpf, $data_nasc, $senha;

    public function save()
    {
        $dao = new CorrentistaDAO();


    }




}