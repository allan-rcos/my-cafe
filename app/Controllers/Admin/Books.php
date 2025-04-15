<?php

namespace App\Controllers\Admin;

use App\Models\BookModel;
use App\Traits\AdminTraits\IndexViewTrait;
use App\Traits\AdminTraits\RemoveActionTrait;

class Books extends AdminBaseController
{
    protected $permissions       = [
        'index'  => 'book.show',
        'remove' => 'book.remove'
    ];

    protected $permissionMessages = [
        'index'  => 'Você não tem permissão para visualizar Reservas',
        'remove' => 'Você não tem permissão para remover Reservas'
    ];

    protected $successMessages    = [
        'remove' => 'Reserva removida com sucesso'
    ];

    protected $views = [
        'index' => 'admin/book/index'
    ];

    protected $modelType          = BookModel::class;


    protected $table_dir          = 'books';
    protected $table_header       = [
        'id'       => '#',
        'datetime' => 'Data e Hora',
        'user'     => 'Usuário',
        'message'  => 'Mensagem'
    ];

    protected $redirectRoute       = 'books';

    use IndexViewTrait;
    use RemoveActionTrait;

    public function formatRow(array $row): array
    {
        helper('format');

        $row['datetime'] = time_format($row['datetime']);
        return $row;
    }
}

