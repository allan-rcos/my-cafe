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
        'name'         => 'required|is_unique[products.name]|max_length[31]|alpha_numeric_space|min_length[3]',
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

    public function count(): int
    {
        return (int) $this->db->table($this->table)
            ->select([
                'COUNT('.$this->table.'.id) as count',
            ])
            ->get()
            ->getResult()[0]->count;
    }

    /**
     * Validate the row data against the validation rules (or the validation group)
     * specified in the class property, $validationRules.
     *
     * @param         array|object     $row Row data
     */
    public function validate($row, ?bool $cleanValidationRules = null): bool
    {
        if ($cleanValidationRules === null) $cleanValidationRules = $this->cleanValidationRules;
        if ($this->skipValidation) {
            return true;
        }

        $rules = $this->getValidationRules();

        if ($rules === []) {
            return true;
        }

        // Validation requires array, so cast away.
        if (is_object($row)) {
            $row = (array) $row;
        }

        if ($row === []) {
            return true;
        }

        $rules = $cleanValidationRules ? $this->cleanValidationRules($rules, $row) : $rules;

        // If no data existed that needs validation
        // our job is done here.
        if ($rules === []) {
            return true;
        }

        $this->ensureValidation();

        $this->validation->reset()->setRules($rules, $this->validationMessages);

        return $this->validation->run($row, null, $this->DBGroup);
    }

}
