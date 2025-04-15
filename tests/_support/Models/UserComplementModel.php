<?php

namespace Tests\Support\Models;

use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Tests\Support\Entities\UserComplementEntity;

/**
 * @method array<UserComplementEntity> findAll(?int $limit = null, int $offset = 0)
 * @method UserComplementEntity find($id = null)
 * @property ValidationInterface $validation
 */
class UserComplementModel extends Model
{
    const     TABLE             = 'user_complement';
    protected $table            = self::TABLE;

    const     PRIMARY_KEY       = 'user_id';
    protected $primaryKey       = self::PRIMARY_KEY;

    protected $useAutoIncrement = false;

    protected $returnType       = UserComplementEntity::class;
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = false;

    protected $allowedFields    = ['user_id', 'name', 'photo', 'phone', 'address'];

    protected $validationRules = [
        'user_id'  => 'required|is_unique['. self::TABLE .'.' . self::PRIMARY_KEY . ']|numeric',
        'name'     => 'required|max_length[60]|alpha_accented_numeric_space|min_length[3]',
        'photo'    => 'required',
        'phone'    => 'required|numeric|min_length[11]|max_length[11]',
        'address'  => 'required|max_length[255]'
    ];
}