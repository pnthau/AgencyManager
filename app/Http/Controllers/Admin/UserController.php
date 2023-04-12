<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Admin\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\Users\DataTable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\PseudoTypes\LowercaseString;

class UserController extends Controller
{
    use DataTable;

    public function __construct()
    {
        $currentRoute = $this->getCurrentRoute();
        $explode = explode('.', $currentRoute);
        $ucfirst = array_map('ucfirst', $explode);
        $title = implode(' / ', $ucfirst);

        View::share('title', $title);
        View::share('companies', Company::get());
        View::share('table', $this->table());
        View::share('getAllUserRoleNames', UserRoleEnum::getAllUserRoleNames());
    }

    public function showDatatable(Request $request)
    {
        $viewData = [];
        $viewData['cities'] = $this->model()->query()->distinct()->get(['city as name']);

        $query = $this->model()->query();
        if ($request->filled('role')) {
            $query->where('role', $request->role);
            // dd($qury)
        }
        if ($request->filled('keywords')) {
            $query->where(function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->keywords}%")
                    ->orWhere('email', 'like', "%{$request->keywords}%");
            });
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('company')) {
            $query->where('company_id', $request->company);
        }
        $viewData['users'] = $query->orderBy('id', 'desc')
            ->with('company:id,name')
            ->paginate(10)
            ->appends($request->all());
        //set value flash session old .
        session()->flashInput($request->input());

        return view($this->prefix() . 'index')
            ->with('viewData', $viewData);
    }

    public function showDetail()
    {
        return view($this->prefix() . 'show');
    }

    public function prefix()
    {
        return 'admin.users.';
    }
}
