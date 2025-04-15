<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;


/**
 * @property       int            $user_id
 * @property       string         $name
 * @property       string         $photo
 * @property       string         $phone
 * @property       string         $address
 * @property       string         $username
 * @property       string         $email
 */
class CompleteUserEntity extends Entity
{
    protected $attributes = [
        'user_id'  => null,
        'name'     => null,
        'photo'    => null,
        'phone'    => null,
        'address'  => null,
        'username' => null,
        'email'    => null
    ];

    protected $casts = [
        'user_id'  => 'int',
        'name'     => 'string',
        'photo'    => 'string',
        'phone'    => 'string',
        'address'  => 'string',
        'username' => 'string',
        'email'    => 'string'
    ];

    public function formated_name(): string
    {
        return "User: $this->user_id - $this->username";
    }

    public function __toString()
    {
        return $this->formated_name();
    }
}