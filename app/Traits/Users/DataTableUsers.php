<?php

namespace App\Traits\Users;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

trait DataTableUsers
{
    use RedirectsUsers;

    public function showDatatableUsers(Request $request)
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
            // dd($qury)
        }
        if ($request->filled('company')) {
            $query->where('company_id', $request->company);
            // dd($qury)
        }
        $viewData['users'] = $query->orderBy('id', 'desc')
            ->with('company:id,name')
            ->paginate(10)
            ->appends($request->all());
        //set value old.
        session()->flashInput($request->input());
        return view('admin.users.index')
            ->with('viewData', $viewData);
    }

    public function showUserDetail()
    {
        return view('admin.users.show');
    }

    // public function searchUsers(Request $request)
    // {
    //     extract($request->all());
    //     $viewData = [];
    //     $keyword = "%$keyword%";

    //     $users = $this->model()
    //         ->where('role', $role)
    //         ->orWhere(function ($query) use ($role, $keyword) {
    //             return $query->where('role', $role)
    //                 ->where(function ($query) use ($keyword) {
    //                     return $query
    //                         ->where('name', 'like', $keyword)
    //                         ->orWhere('email', 'like', $keyword);
    //                 });
    //         })
    //         ->orderBy('id', 'desc')
    //         ->with('company:id,name')
    //         ->paginate(10);
    //     //save pagination and add role_name into users' data

    //     $viewData['users'] = $users->toArray();
    //     $viewData['users'] = array_replace(
    //         $viewData['users'],
    //         ['data' => $users->each(function ($user) {
    //             $user['role_name'] = $user->role_name;
    //         })->toArray()]
    //     );
    //     //Change role'key to  role'name
    //     return json_encode($viewData['users']);
    // }
    public function searchUsers(Request $request)
    {
        return redirect()
            ->route('users.search')
            ->with(
                'request',
                $request->all(['keyword', 'role'])
            );
    }
}
