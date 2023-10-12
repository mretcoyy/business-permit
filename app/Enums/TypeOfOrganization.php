<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TypeOfOrganization extends Enum
{
    const SINGLE = 1;
    const PARTNERSHIP = 2;
    const CORPORATION = 3;
    const COOPERATIVE = 4;
}
