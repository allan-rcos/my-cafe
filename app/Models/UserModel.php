<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;
use JetBrains\PhpStorm\Deprecated;

#[Deprecated]
class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
            'name',
            'address',
            'complement',
            'zip',
            'phone'
        ];
    }
}
