<?php

namespace Tests\Support\Entities;

use CodeIgniter\Entity\Entity;


/**
 * @property       int            $id
 * @property       int            $user_id
 * @property       int            $product_id
 * @property       int            $quantity
 * @property       \DateTime      $checked_at
 */
class DeliveryItemEntity extends Entity
{
    protected $attributes = [
        'id'         => null,
        'user_id'    => null,
        'product_id' => null,
        'quantity'   => null,
        'checked_at' => null
    ];

    protected $casts = [
        'id'         => 'int',
        'user_id'    => 'int',
        'product_id' => 'int',
        'quantity'   => 'int',
        'checked_at' => 'datetime'
    ];

    public function formated_name(): string
    {
        return "DeliveryItem: $this->user_id (x$this->quantity - $this->product_id)";
    }

    public function __toString()
    {
        return $this->formated_name();
    }
}