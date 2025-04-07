<?php

//use CodeIgniter\I18n\Time;
/** @var $table string */
//helper('format')

?>
<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

    <h2>Produtos</h2>
    <?= $table ?>
    <!--<table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Preço</th>
            <th scope="col">Categoria</th>
            <th scope="col">Descrição</th>
            <th scope="col"><a href="<?php /*= url_to('products-create') */?>"><i class="icon ion-plus icon-badge bg-success"></i></a></th>
        </tr>
        </thead>
        <tbody>
        <?php /*foreach($products as $item): */?>
            <tr>
                <th scope="row"><?php /*= $item->id */?></th>
                <td><?php /*= $item->name */?></td>
                <td><?php /*= price_format($item->price) */?></td>
                <td><?php /*= $item->category */?></td>
                <td><?php /*= $item->description */?></td>
                <td>
                    <a href="<?php /*= url_to('products-edit', $item->id) */?>"><i class="icon ion-edit icon-badge"></i></a>
                    <a href="<?php /*= url_to('products-remove', $item->id) */?>"><i class="icon ion-trash-b icon-badge"></i></a>
                </td>
            </tr>
        <?php /*endforeach; */?>

        </tbody>
    </table>-->
<?= $this->endSection() ?>