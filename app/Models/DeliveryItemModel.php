<?php

namespace App\Models;

use App\Models\Interface\IAdminModel;
use App\Traits\Models\ValidateTrait;
use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Tests\Support\Entities\DeliveryItemEntity;

/**
 * @method array<DeliveryItemEntity> findAll(?int $limit = null, int $offset = 0)
 * @method DeliveryItemEntity find($id = null)
 * @property ValidationInterface $validation
 */
class DeliveryItemModel extends Model implements IAdminModel
{
    use ValidateTrait;

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

    public function findAllTableData(int $limit = 10, string $order_by = 'id', string $order = 'ASC'): array
    {
        if (!str_contains('.', $order_by))
            $order_by = self::TABLE . '.' . $order_by;
        $data = $this->db->table($this->table)
            ->select([
                self::TABLE.'.checked_at as checkout',
                self::TABLE.'.user_id',
                UserComplementModel::TABLE.'.name as user',
                'GROUP_CONCAT(CONCAT(\'x\', '.self::TABLE. '.quantity, \' \', ' .ProductModel::TABLE.".name) SEPARATOR ', ') as products",
                'SUM('. self::TABLE .'.quantity * '. ProductModel::TABLE .'.price) as total',
            ])
            ->join(UserComplementModel::TABLE,
                self::TABLE . '.user_id = ' . UserComplementModel::TABLE . '.' . UserComplementModel::PRIMARY_KEY,
                'left')
            ->join(ProductModel::TABLE,
                self::TABLE . '.product_id = ' . ProductModel::TABLE . '.' . ProductModel::PRIMARY_KEY,
                'left')
            ->where(self::TABLE.'.checked_at IS NOT NULL')
            ->groupBy([self::TABLE.'.user_id', self::TABLE.'.checked_at'])
            ->orderBy($order_by, $order)
            ->get($limit)
            ->getResult('array');
        for ($i = 0; $i < count($data); $i+=1) $data[$i]['id'] = [$data[$i]['user_id'], $data[$i]['checkout']];

        return $data;
    }

    public function findAllCart(int $user_id): array
    {
        return $this->db->table($this->table)
            ->select([
                self::TABLE.'.product_id',
                self::TABLE.'.quantity',
                ProductModel::TABLE.'.name',
                ProductModel::TABLE.'.price',
                ProductModel::TABLE.'.filename',
                ProductModel::TABLE.'.description',
                ProductModel::TABLE.'.category_id'
            ])
            ->join(ProductModel::TABLE,
                self::TABLE . '.product_id = ' . ProductModel::TABLE . '.' . ProductModel::PRIMARY_KEY,
                'left')
            ->where(self::TABLE.'.checked_at IS NULL')
            ->where(self::TABLE.'.user_id', $user_id)
            ->get()
            ->getResult('array');
    }

    public function count(): int
    {
        $result = $this->db->table(self::TABLE)
            ->select([
                'COUNT(DISTINCT(checked_at)) as count', // Can give a wrong response if multiple users check at the same time.
            ])
            ->where('checked_at IS NOT NULL')
            ->groupBy('user_id')
            ->get()
            ->getResult();
        if (!$result) return 0;
        return (int) $result[0]->count;
    }

    public function updateMany(array $quantity, int $user_id, string $checked_at): bool
    {
        $values = [];
        $keys = [];
        $table = self::TABLE;
        $primary_key = self::PRIMARY_KEY;
        $bindings = [
            'user_id'     => $user_id,
            'checked_at'  => $checked_at
        ];
        $count = 0;
        foreach ($quantity as $key => $value) {
            $count            += 1;
            $bkey              = 'key_'.$count;
            $bvalue            = 'val_'.$count;

            $keys[]            = ":$bkey:";
            $values[]          = "WHEN :$bkey: THEN :$bvalue:";
            $bindings[$bkey]   = $key;
            $bindings[$bvalue] = $value;
        }
        $case = join(' ', $values).' END';
        $in   = join(', ', $keys);

        $sql = "UPDATE $table
                SET $table.quantity = CASE $table.$primary_key $case
                WHERE $table.$primary_key in ($in)
                  AND $table.user_id = :user_id:
                  AND $table.checked_at = :checked_at:";

        $query = new Query($this->db);
        $query->setQuery($sql);
        $query->setBinds($bindings);
        return $this->db->query($query->getQuery());
    }

    public function findUserDelivery(int $user_id, string $checked_at): array
    {
        return $this->db->table($this->table)
            ->select([
                self::TABLE.'.'.self::PRIMARY_KEY,
                self::TABLE.'.quantity',
                ProductModel::TABLE.'.name',
                ProductModel::TABLE.'.price'
            ])
            ->join(ProductModel::TABLE,
                self::TABLE . '.product_id = ' . ProductModel::TABLE . '.' . ProductModel::PRIMARY_KEY,
                'left')
            ->where(self::TABLE.'.user_id', $user_id)
            ->where(self::TABLE.'.checked_at', $checked_at)
            ->get()
            ->getResult();
    }

    public function checkout(int $user_id): bool
    {
        return $this->db->table($this->table)
            ->set('checked_at', (new \DateTime('now'))->format('Y-m-d H:i:s'))
            ->where('user_id', $user_id)
            ->where('created_at is NULL')
            ->update()
        ;
    }
}