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
    const     TABLE             = 'categories';
    protected $table            = self::TABLE;

    const     PRIMARY_KEY       = 'id';

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

    /** @return array<string|string> */
    public function findAllSelect(): array
    {
        $result = $this->db->table($this->table)
            ->select([ 'id', 'name' ])
            ->get()
            ->getResult();

        $select_options = [];
        foreach ($result as $item)
            $select_options["id-".$item->id] = $item->name;

        return $select_options;
    }

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