<?php

namespace App\Domains\Common\Enums;

enum StatusEnum: string
{
    case ERROR = 'error';

    const SUCCESS = 'success';
}
