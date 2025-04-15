<?php

namespace Tests\Support\Entities;

use CodeIgniter\Entity\Entity;


/**
 * @property       int            $user_id
 * @property       string         $name
 * @property       string         $photo
 * @property       string         $phone
 * @property       string         $address
 */
class UserComplementEntity extends Entity
{
    protected $attributes = [
        'user_id' => null,
        'name'    => null,
        'photo'   => null,
        'phone'   => null,
        'address' => null
    ];

    protected $casts = [
        'user_id' => 'int',
        'name'    => 'string',
        'photo'   => 'string',
        'phone'   => 'string',
        'address' => 'string'
    ];

    public function formated_name(): string
    {
        return "Complement from user: $this->user_id - $this->name";
    }

    public function __toString()
    {
        return $this->formated_name();
    }
}
