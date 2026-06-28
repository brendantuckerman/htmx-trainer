<?php

namespace App\Enum;

enum SessionStatus: string
{
    case Planned = 'planned';
    case Completed = 'completed';
    case Skipped = 'skipped';
}
