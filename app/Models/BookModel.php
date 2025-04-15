<?php

namespace App\Models;

use App\Models\Interface\IAdminModel;
use App\Traits\Models\CountTrait;
use App\Traits\Models\ValidateTrait;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use App\Entities\BookEntity;

/**
 * @method array<BookEntity> findAll(?int $limit = null, int $offset = 0)
 * @method BookEntity find($id = null)
 * @property ValidationInterface $validation
 */
class BookModel extends Model implements IAdminModel
{
    use ValidateTrait;
    use CountTrait;

    const     TABLE             = 'books';
    protected $table            = self::TABLE;

    const     PRIMARY_KEY       = 'id';

    protected $returnType       = BookEntity::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['user_id', 'datetime', 'message'];

    protected $validationRules  = [
        'user_id'  => 'required|numeric|is_not_unique['. UserComplementModel::TABLE . '.' . UserComplementModel::PRIMARY_KEY .']',
        'datetime' => 'required',
        'message'  => 'required|max_length[255]'
    ];

    public function findAllTableData(int $limit = 10, string $order_by = 'id', string $order = 'ASC'): array
    {
        return $this->db->table($this->table)
            ->select([
                self::TABLE.'.id',
                self::TABLE.'.datetime',
                self::TABLE.'.message',
                UserComplementModel::TABLE.'.name as user',
            ])
            ->join(UserComplementModel::TABLE,
                self::TABLE . '.user_id = ' . UserComplementModel::TABLE . '.' . UserComplementModel::PRIMARY_KEY ,
                'left')
            ->orderBy($order_by, $order)
            ->get($limit)
            ->getResult('array');
    }
}