<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => 'Controle total do site.',
        ],
        'admin' => [
            'title'       => 'Admin',
            'description' => 'Administra outros usuários.',
        ],
        'developer' => [
            'title'       => 'Desenvolvedor',
            'description' => 'Desenvolvedores do site.',
        ],
        'book-admin' => [
            'title'       => 'Administrador de Reservas',
            'description' => 'Visualiza e remove as Reservas.',
        ],
        'delivery-admin' => [
            'title'       => 'Administrador de Pedidos',
            'description' => 'Visualiza e remove os Pedidos.',
        ],
        'products-admin' => [
            'title'       => 'Administrador de Produtos',
            'description' => 'Pode visualizar, criar, editar e remover Produtos.',
        ],
        'category-admin' => [
            'title'       => 'Administrador de Categorias',
            'description' => 'Pode visualizar, criar, editar e remover Categorias (controle indireto sobre produtos).',
        ],
        'user' => [
            'title'       => 'Usuário',
            'description' => 'Usuários em geral do site, inclusive clientes.',
        ],
        'beta' => [
            'title'       => 'Usuário Beta',
            'description' => 'Usuário em geral que possui acesso a conteúdo Beta.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'admin.manage'        => 'Pode gerenciar outros admins.',
        'admin.settings'      => 'Pode alterar as configurações do site.',
        'users.access'        => 'Pode visualizar os usuários.',
        'users.create'        => 'Pode criar novos usuários não admins.',
        'users.edit'          => 'Pode editar usuários não admins.',
        'users.delete'        => 'Pode remover usuários não admins.',
        'book.show'           => 'Pode acessar as reservas.',
        'book.delete'         => 'Pode excluir reservas.',
        'delivery.show'       => 'Pode acessar os pedidos.',
        'delivery.edit'       => 'Pode editar pedidos.',
        'delivery.delete'     => 'Pode remover pedidos.',
        'products.show'       => 'Pode acessar os produtos.',
        'products.create'     => 'Pode criar novos produtos',
        'products.edit'       => 'Pode editar produtos.',
        'products.delete'     => 'Pode remover produtos.',
        'category.show'       => 'Pode acessar categorias.',
        'category.create'     => 'Pode criar novas categorias.',
        'category.edit'       => 'Pode editar categorias.',
        'category.delete'     => 'Pode remover categorias (e produtos ligados a elas).',
        'beta.access'         => 'Pode acessar conteúdo beta.',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => [
            'admin.*',
            'users.*',
            'book.*',
            'delivery.*',
            'products.*',
            'category.*',
            'beta.*',
        ],
        'admin' => [
            'users.*',
            'beta.access',
        ],
        'developer' => [
            'admin.settings',
            'users.access',
            'users.create',
            'users.edit',
            'book.*',
            'delivery.*',
            'products.*',
            'category.*',
            'beta.access',
        ],
        'book-admin' => [
            'book.*'
        ],
        'delivery-admin' => [
            'delivery.*'
        ],
        'products-admin' => [
            'products.*'
        ],
        'category-admin' => [
            'category.*'
        ],
        'user' => [],
        'beta' => [
            'beta.access',
        ],
    ];
}
