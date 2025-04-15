<?php

namespace App\Traits\Models;

trait CountTrait
{
    public function count(): int
    {
        return (int) $this->db->table(self::TABLE)
            ->select([
                'COUNT('.self::TABLE.'.'.self::PRIMARY_KEY.') as count',
            ])
            ->get()
            ->getResult()[0]->count;
    }
}