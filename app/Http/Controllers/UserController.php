<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\Users\DataTableUsers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    use DataTableUsers;

    public function __construct()
    {
        $currentRoute = Route::currentRouteName();
        $explode = explode('.', $currentRoute);
        $ucfirst = array_map('ucfirst', $explode);
        $title = implode(' / ', $ucfirst);

        View::share('title', $title);
        View::share('companies', Company::get());
        View::share('table', $this->table());
        View::share('getAllUserRoleNames', UserRoleEnum::getAllUserRoleNames());
    }

    public function model()
    {
        return app()->instance('authenticatable', new User());
    }

    public function table()
    {
        return 'users';
    }
}
