<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BusinessStatus extends Enum
{
    const NEW = 1;
    const RENEW = 2;
    const CHECKREQUIREMENTS = 10;
    const CHECKREQUIREMENTS2 = 11;
    const TAXCOMPUTATION = 13;
    const PAYMENT = 14;
    const MAYORSPERMIT = 3;
}
