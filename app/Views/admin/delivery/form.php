<?php

use App\Libraries\FileManager;
use App\Entities\CompleteUserEntity;

helper('form');
/** @var FileManager $file_manager
  * @var array $itens
  * @var CompleteUserEntity $user
  * */
helper('form');
$file_manager = service('file_manager');
?>

<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>

<div class="form-create">
    <h2>Editar Categoria</h2>
    <div class="user-card">
        <img src="<?= base_url(str_replace('\\', '/', $file_manager::URI).'/'.$user->photo) ?>"
             alt="<?= $user->name ?>">
        <div>
            <p>Nome: <?= $user->name ?></p>
            <p class="col-3">Usuário: <?= $user->email ?></p> <p class="col-6">Email: <?= $user->email ?></p> <p class="col-3">Telefone: <?= $user->phone ?></p>
            <p>Endereço: <?= $user->address ?></p>
        </div>
    </div>
    <?php
    echo validation_list_errors();
    echo form_open_multipart(current_url(), ['data-bs-theme' => 'dark']);
    ?>
    <div class="delivery-item-container">
        <?php foreach($itens as $item): ?>
            <div class="delivery-item">
                <a href="<?= url_to('delivery-item-remove', $item->id) ?>">Remover</a>
                <span class="delivery-item-name"><?= $item->name ?></span>
                <span class="delivery-item-price"><?= $item->price ?></span>
                <?= form_input(
                    [
                        'class'       => 'form-control',
                        'name'        => ((string) $item->id),
                        'placeholder' => "Quantidade",
                        'required'    => true
                    ],
                    value: $item->quantity,
                    type: 'number'
                ); ?>
            </div>
        <?php endforeach ?>
    </div>

    <?= form_submit(value: 'Salvar', extra: ['class' => 'd-grid col-12 col-md-8 mx-auto m-3']) ?>
    <?= form_close(); ?>
</div>
<?= $this->endSection(); ?>
