<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getClassModel()
    {
        $explode = explode('\\', $this::class);
        $nameController = end($explode);
        $suffix = "Controller";
        return $nameModel = substr(
            $nameController,
            0,
            strpos($nameController, $suffix)
        );
    }

    protected function model()
    {
        $model = "App\\Models\\{$this->getClassModel()}";
        return app()->instance('model', new $model());
    }

    protected function table()
    {
        $suffix = "s";
        return strtolower($this->getClassModel()) . $suffix;
    }

    protected function getCurrentRoute()
    {
        return Route::currentRouteName();
    }
}
