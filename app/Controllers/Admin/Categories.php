<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use App\Traits\AdminTraits\CreateActionTrait;
use App\Traits\AdminTraits\CreateViewTrait;
use App\Traits\AdminTraits\EditActionTrait;
use App\Traits\AdminTraits\EditViewTrait;
use App\Traits\AdminTraits\IndexViewTrait;
use App\Traits\AdminTraits\RemoveActionTrait;

class Categories extends AdminBaseController
{
    protected $permissions       = [
        'create' => 'category.create',
        'index'  => 'category.show',
        'edit'   => 'category.edit',
        'remove' => 'category.remove'
    ];

    protected $permissionMessages = [
        'create' => 'Você não tem permissão para criar Categorias',
        'index'  => 'Você não tem permissão para visualizar Categorias',
        'edit'   => 'Você não tem permissão para editar Categorias',
        'remove' => 'Você não tem permissão para remover Categorias'
    ];

    protected $successMessages    = [
        'create' => 'Reserva criada com sucesso',
        'edit'   => 'Reserva editada com sucesso',
        'remove' => 'Reserva removida com sucesso'
    ];

    protected $views = [
        'create' => 'admin/categories/form',
        'index'  => 'admin/categories/index',
        'edit'   => 'admin/categories/form',
    ];

    protected $modelType          = CategoryModel::class;


    protected $table_dir          = 'categories';
    protected $table_header       = [
        'id' => '#',
        'name' => 'Nome',
        'description' => 'Descrição'
    ];

    protected $redirectRoute       = 'categories';

    use IndexViewTrait;
    use CreateViewTrait;
    use CreateActionTrait;
    use EditViewTrait;
    use EditActionTrait;
    use RemoveActionTrait;
}
