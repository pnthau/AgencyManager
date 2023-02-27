<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRoleEnum extends Enum
{
    const ADMIN = 0;
    const SUPERADMIN = 1;
    const HR = 2;
    const CANDIDATE = 3;

    public static function getUserRoleName()
    {
        return [
            'Admin' => self::ADMIN,
            'SuperAdmin' => self::SUPERADMIN,
            'HR' => self::HR,
            'Candidate' => self::CANDIDATE,
        ];
    }

    public static function getUserRoleNameByValue($value)
    {
        return array_search($value, self::getUserRoleName());
    }

    public static function getUserRoleByKey($key)
    {
        return array_keys(self::getUserRoleName())[$key];
    }
}
