<?php

namespace App\Model;

use Exception;

// abstract class não pode ser instanciada
abstract class Model
{
    /**
     * Propriedade que armazenará o array retornando da DAO
     */
    public $rows;
}