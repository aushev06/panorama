<?php

declare(strict_types=1);

namespace App\Filters;


use Illuminate\Http\Request;

abstract class QueryFilter
{
    public $builder;
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {

        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $filter => $value) {
            if (true === method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        return $this->request->all();
    }
}
