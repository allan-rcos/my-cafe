<?php

namespace Tests\Support\Models;

use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Tests\Support\Entities\BookEntity;

/**
 * @method array<BookEntity> findAll(?int $limit = null, int $offset = 0)
 * @method BookEntity find($id = null)
 * @property ValidationInterface $validation
 */
class BookModel extends Model
{
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
}