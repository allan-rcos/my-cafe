<?php

namespace Tests\Support\Casts;

use CodeIgniter\Entity\Cast\BaseCast;
use InvalidArgumentException;
use UnexpectedValueException;
use Tests\Support\Entities\CategoryEntity;
use Tests\Support\Models\CategoryModel;

class CategoryIdCast extends BaseCast
{
    /**
     * @param CategoryEntity|int $value
     * @param array $params
     * @return int
     * @throws UnexpectedValueException
     */
    public static function set($value, array $params = []): int
    {
        $model = model(CategoryModel::class);

        if (is_string($value))
            $value = str_replace('id-', '', $value);
        if (is_int($value) || filter_var($value, FILTER_VALIDATE_INT) !== false)
            $entity = $model->find($value);
        else if ($value instanceOf CategoryEntity)
            $entity = $model->find($value->id);
        else throw new InvalidArgumentException('Invalid category_id.');

        if (!$entity) throw new UnexpectedValueException("Category not found.");

        return $entity->id;
    }
}