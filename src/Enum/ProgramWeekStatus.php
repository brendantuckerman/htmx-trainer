<?php

namespace App\Enum;

enum ProgramWeekStatus: string
{
    case Normal = 'normal';
    case Base = 'base';
    case Build = 'build';
    case Deload = 'deload';
    case Peak = 'peak';
    case Race = 'race';
    case Recovery = 'recovery';
}
