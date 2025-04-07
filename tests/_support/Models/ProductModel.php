<?php

namespace Tests\Support\Models;

use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use stdClass;
use Tests\Support\Casts\CategoryIdCast;
use Tests\Support\Entities\ProductEntity;

/**
 * @method array<ProductEntity> findAll(?int $limit = null, int $offset = 0)
 * @method ProductEntity find($id = null)
 * @property ValidationInterface $validation
 */
class ProductModel extends Model
{
    protected $table            = 'products';

    protected $returnType       = ProductEntity::class;
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;

    protected $allowedFields    = ['name', 'price', 'filename', 'description', 'category_id'];

    protected array $casts = [
        'id'          => 'int',
        'price'       => 'float',
        'category_id' => 'category_id',
    ];

    protected array $castHandlers = [
        'category_id' => CategoryIdCast::class
    ];

    protected $validationRules = [
        'name'         => 'required|is_unique[products.name]|max_length[31]|alpha_numeric_space|min_length[3]',
        'price'        => 'required|numeric|greater_than[0]|min_length[3]',
        'filename'     => 'required|max_length[31]',
        'description'  => 'required|max_length[255]',
        'category_id'  => 'required'
    ];

    /**
     * @return array<stdClass>
     */
    public function findAllJoin(int $limit = 10, string $order_by = 'id', string $order = 'ASC'): array
    {
        return $this->db->table($this->table)
            ->select([
                $this->table.'.id',
                $this->table.'.name',
                $this->table.'.price',
                $this->table.'.description',
                'categories.name as category',
                $this->table.'.created_at',
                $this->table.'.updated_at'
            ])
            ->join('categories', 'products.id = categories.id', 'left')
            ->orderBy($order_by, $order)
            ->get($limit)
            ->getResult();
    }

}
