<?php

namespace App\Enums;

enum AdminViewEnum: string
{
    case CREATE = 'create';
    case INDEX  = 'index';
    case EDIT   = 'edit';
    case REMOVE = 'remove';
}
