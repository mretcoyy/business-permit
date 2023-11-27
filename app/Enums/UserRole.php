<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserRole extends Enum
{
    const ADMIN = 1;
    const USER = 2;
    const BPLO = 3;
    const MENRO = 4;
    const MPDC = 5;
    const ENGR = 6;
    const SNTRY = 7;
    const BFP = 8;
    const TREASURER = 9;
}
