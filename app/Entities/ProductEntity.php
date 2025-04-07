<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use DateTime;
use Tests\Support\Casts\CategoryIdCast;
use Tests\Support\Models\CategoryModel;
use UnexpectedValueException;

/**
 * @property       int            $id
 * @property       string         $name
 * @property       float          $price
 * @property       string         $filename
 * @property       string         $description
 * @property       int            $category_id
 * @property       CategoryEntity $category
 * @property       DateTime       $created_at
 * @property       DateTime       $updated_at
 */
class ProductEntity extends Entity
{
    protected $attributes = [
        'id'          => null,
        'name'        => null,
        'price'       => null,
        'filename'    => null,
        'description' => null,
        'category_id' => null,
        'created_at'  => null,
        'updated_at'  => null,
    ];

    protected $casts = [
        'id'          => 'int',
        'name'        => 'string',
        'price'       => 'float',
        'filename'    => 'string',
        'description' => 'string',
        'category_id' => 'category_id',
    ];

    protected $castHandlers = [
        'category_id' => CategoryIdCast::class
    ];

    public function getCategory() : CategoryEntity
    {
        $model = new CategoryModel();

        /** @var $entity CategoryEntity|null */
        $entity = $model->find($this->category_id);

        if (!$entity) throw new UnexpectedValueException("Category not found.");

        return $entity;
    }

    public function __get(string $key)
    {
        if ($key === 'category') return $this->getCategory();
        return parent::__get($key);
    }

    public function formated_name(): string
    {
        return "Product: $this->id - $this->name";
    }

    public function __toString()
    {
        return $this->formated_name();
    }
}