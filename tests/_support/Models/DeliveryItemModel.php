<?php

namespace Tests\Support\Models;

use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Tests\Support\Entities\DeliveryItemEntity;

/**
 * @method array<DeliveryItemEntity> findAll(?int $limit = null, int $offset = 0)
 * @method DeliveryItemEntity find($id = null)
 * @property ValidationInterface $validation
 */
class DeliveryItemModel extends Model
{
    const     TABLE             = 'delivery_itens';
    protected $table            = self::TABLE;

    const     PRIMARY_KEY       = 'id';

    protected $returnType       = DeliveryItemEntity::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['user_id', 'product_id', 'quantity', 'checked_at'];

    protected $validationRules  = [
        'user_id'    => 'required|numeric|is_not_unique['. UserComplementModel::TABLE . '.' . UserComplementModel::PRIMARY_KEY .']',
        'product_id' => 'required|numeric|is_not_unique['. ProductModel::TABLE . '.' . ProductModel::PRIMARY_KEY .']',
        'quantity'   => 'required|numeric|greater_than[0]',
    ];

    public function checkout(int $user_id): bool
    {
        return $this->db->table($this->table)
            ->set('checked_at', (new \DateTime('now'))->format('Y-m-d H:i:s'))
            ->where('user_id', $user_id)
            ->update()
        ;
    }
}