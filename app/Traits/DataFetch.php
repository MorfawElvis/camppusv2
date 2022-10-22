<?php

namespace App\Traits;

trait DataFetch
{
    public function getAllData($model)
    {
        return $model::all();
    }
    public function getFirstData($model)
    {
        return $model::first();
    }
}

