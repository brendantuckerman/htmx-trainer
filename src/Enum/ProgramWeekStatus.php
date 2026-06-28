<?php

namespace App\Enum;

enum ProgramWeekStatus: string
{
    case Normal = 'normal';
    case Deload = 'deload';
    case Peak = 'peak';
    case Recovery = 'recovery';
}
