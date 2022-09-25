<?php

namespace App\Enum;

enum UserType:int
{
    case ADMIN = 1;
    case SINGER = 2;
    case PAYER = 3;
    case FREMIUM = 4;
}
