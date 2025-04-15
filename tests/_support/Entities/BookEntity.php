<?php

namespace Tests\Support\Entities;

use CodeIgniter\Entity\Entity;
use DateTime;


/**
 * @property       int            $id
 * @property       int            $user_id
 * @property       DateTime       $dateTime
 * @property       string         $message
 */
class BookEntity extends Entity
{
    protected $attributes = [
        'id'       => null,
        'user_id'  => null,
        'datetime' => null,
        'message'  => null
    ];

    protected $casts = [
        'id'       => 'int',
        'user_id'  => 'int',
        'datetime' => 'datetime',
        'message'  => 'string'
    ];

    public function formated_name(): string
    {
        return "Book: $this->id: $this->user_id";
    }

    public function __toString()
    {
        return $this->formated_name();
    }
}