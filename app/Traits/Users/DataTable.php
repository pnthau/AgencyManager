<?php

namespace App\Traits\Users;

use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;

trait DataTable
{
    use RedirectsUsers;
    public function destroy(Request $request)
    {
        if ($request->filled('id')) {
            $this->model()::destroy($request->id);
            return redirect()->back();
        }
    }
}
