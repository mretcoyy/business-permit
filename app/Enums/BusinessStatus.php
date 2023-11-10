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
    const BPLOAPPROVAL = 10;
    const MENRO = 11;
    const MPDC = 12;
    const ENGINEERING = 13;
    const SANITARY = 14;
    const BFP = 15;
    const PAYMENT = 16;
    const MAYORSPERMIT = 17;
    const FORAPPROVAL = 4;
    const APPROVED = 5;
    const DECLINED = 6;
}
