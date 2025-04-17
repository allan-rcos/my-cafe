<?php

namespace App\Models;

use App\Models\Interface\IAdminModel;
use App\Traits\Models\CountTrait;
use App\Traits\Models\ValidateTrait;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use App\Casts\CategoryIdCast;
use App\Entities\ProductEntity;

/**
 * @method array<ProductEntity> findAll(?int $limit = null, int $offset = 0)
 * @method ProductEntity find($id = null)
 * @property ValidationInterface $validation
 */
class ProductModel extends Model implements IAdminModel
{
    use ValidateTrait;
    use CountTrait;

    const     TABLE             = 'products';
    protected $table            = self::TABLE;

    const     PRIMARY_KEY       = 'id';

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
        'name'         => 'required|is_unique[products.name]|max_length[31]|alpha_accented_numeric_space|min_length[3]',
        'price'        => 'required|numeric|greater_than[0]',
        'filename'     => 'required|max_length[31]',
        'description'  => 'required|max_length[255]',
        'category_id'  => 'required|not_in_list[placeholder]|is_not_unique['. CategoryModel::TABLE . '.' . CategoryModel::PRIMARY_KEY .']'
    ];

    protected $validationMessages = [
        'category_id' => [
            'not_in_list' => 'A Categoria é obrigatória.' // 'The category is required'
        ]
    ];

    public function findAllTableData(int $limit = 10, string $order_by = 'id', string $order = 'ASC'): array
    {
        return $this->db->table($this->table)
            ->select([
                $this->table.'.id',
                $this->table.'.name',
                $this->table.'.price',
                $this->table.'.description',
                CategoryModel::TABLE.'.name as category',
                $this->table.'.created_at',
                $this->table.'.updated_at'
            ])
            ->join(CategoryModel::TABLE,
                self::TABLE.'.category_id = '.CategoryModel::TABLE.'.'.CategoryModel::PRIMARY_KEY,
                'left')
            ->orderBy($order_by, $order)
            ->get($limit)
            ->getResult('array');
    }
    public function findAllMenu(): array
    {
        return $this->db->table($this->table)
            ->select([
                $this->table.'.id',
                $this->table.'.name',
                $this->table.'.price',
                $this->table.'.filename',
                $this->table.'.description',
                $this->table.'.category_id',
                CategoryModel::TABLE.'.name as category'
            ])
            ->join(CategoryModel::TABLE,
                self::TABLE.'.category_id = '.CategoryModel::TABLE.'.'.CategoryModel::PRIMARY_KEY,
                'left')
            ->get()
            ->getResult('array');
    }
}
