<?php

namespace App\ModelFilters;

use App\Enums\UserRoleEnum;

class UserFilter extends ModelFilter
{
    public function role($role)
    {
        return $this->where('role', $role);
    }
    public function keywords($keywords)
    {
        // 'name', 'like', "%$keywords%"
        return $this->where(function ($q) use ($keywords) {
            return $q->where('name', 'like', "%$keywords%")
                ->orWhere('email', 'like', "%$keywords%");
        });
    }
    public function company($company)
    {
        return $this->where('company', $company);
    }
}
