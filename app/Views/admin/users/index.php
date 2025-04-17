<?php

use CodeIgniter\I18n\Time;
use CodeIgniter\Pager\Pager;
/** @var $users \CodeIgniter\Shield\Entities\User[] | null
 * @var $pager Pager  */

helper('format')

?>
<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
    <h2>Usuários</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Nome de Usuário</th>
                <th scope="col">Data de Criação</th>
                <th scope="col">Está Ativo</th>
                <th scope="col"><a href="<?= url_to('user-create') ?>"><i class="icon ion-plus icon-badge bg-success"></i></a></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $item): ?>
                <tr>
                    <th scope="row"><?= $item->id ?></th>
                    <td><?= $item->getEmail() ?></td>
                    <td><?= $item->username ?></td>
                    <td><?= time_format($item->created_at); ?></td>
                    <td><?= bool_format($item->isActivated()); ?></td>
                    <td>
                        <a href="<?= url_to('user-edit', $item->id) ?>"><i class="icon ion-edit icon-badge"></i></a>
                        <a href="<?= url_to('user-remove', $item->id) ?>"><i class="icon ion-trash-b icon-badge"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    <?= $pager->links() ?>
<?= $this->endSection() ?>