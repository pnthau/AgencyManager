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

    public static function getAllRoleName()
    {
        return [self::ADMIN, self::SUPERADMIN, self::HR, self::CANDIDATE];
    }
    public static function getAllUserRoleNames()
    {
        return [
            'Admin' => self::ADMIN,
            'SuperAdmin' => self::SUPERADMIN,
            'HR' => self::HR,
            'Aplicant' => self::CANDIDATE,
        ];
    }

    public static function getUserRoleNameByValue($value)
    {
        return array_search($value, self::getAllUserRoleNames());
    }

    public static function getUserRoleByKey($key)
    {
        return array_keys(self::getAllUserRoleNames())[$key];
    }
}
