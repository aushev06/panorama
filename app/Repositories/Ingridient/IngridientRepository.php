<?php

namespace App\Repositories\Ingridient;


use App\Models\Ingridient\Ingridient;

class IngridientRepository
{

    /**
     * @var Ingridient
     */
    private $model;

    public function __construct(Ingridient $model)
    {


        $this->model = $model;
    }

    public function get()
    {
        //$this->model
    }
}
