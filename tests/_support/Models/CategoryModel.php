<?php

namespace Tests\Support\Models;

use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Tests\Support\Entities\CategoryEntity;

/**
 * @method array<CategoryEntity> findAll(?int $limit = null, int $offset = 0)
 * @method CategoryEntity find($id = null)
 * @property ValidationInterface $validation
 */
class CategoryModel extends Model
{
    protected $table            = 'categories';

    protected $returnType       = CategoryEntity::class;
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;

    protected $allowedFields    = ['name', 'description'];
    protected $beforeDelete     = ['dbTransStart', 'cascateDelete'];
    protected $afterDelete      = ['dbTransComplete'];

    protected $validationRules = [
        'name'         => 'required|is_unique[categories.name]|max_length[31]|alpha_numeric_space|min_length[3]',
        'description'  => 'required|max_length[255]'
    ];

    public static function deleteProducts(int|string $category_id): void
    {
        $product_model = new ProductModel();

        $product_model->where('category_id', $category_id)->delete();
    }

    protected function cascateDelete(array $data): array
    {
        self::deleteProducts($data['id'][0]);
        return $data;
    }

    protected function dbTransStart(array $data): array
    {
        $this->db->transStart();
        return $data;
    }

    protected function dbTransComplete(array $data): array
    {
        $this->db->transComplete();
        return $data;
    }
}