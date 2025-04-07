<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use DateTime;

/**
 * @property       int            $id
 * @property       string         $name
 * @property       string         $description
 * @property       DateTime       $created_at
 * @property       DateTime       $updated_at
 */
class CategoryEntity extends Entity
{
    protected $attributes = [
        'id'          => null,
        'name'        => null,
        'description' => null,
        'created_at'  => null,
        'updated_at'  => null,
    ];

    protected $casts = [
        'id'          => 'int',
        'name'        => 'string',
        'description' => 'string',
    ];

    public function formated_name(): string
    {
        return "Category: $this->id - $this->name";
    }

    public function __toString()
    {
        return $this->formated_name();
    }
}