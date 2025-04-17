<?php

use App\Libraries\FileManager;
use App\Entities\CompleteUserEntity;

helper('format');
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
    <div class="delivery-content">
        <div class="user-card">
            <img src="<?= base_url(str_replace('\\', '/', $file_manager::URI).'/'.$user->photo) ?>"
                 alt="<?= $user->name ?>">
            <div>
                <p><span>Nome:</span> <?= $user->name ?></p>
                <p class="col-3"><span>Usuário:</span> <?= $user->username ?></p> <p class="col-6"> <span>Email:</span> <?= $user->email ?></p> <p class="col-3"><span>Telefone:</span> <?= $user->phone ?></p>
                <p><span>Endereço:</span> <?= $user->address ?></p>
            </div>
        </div>
        <?php
        echo validation_list_errors();
        echo form_open_multipart(current_url(), ['data-bs-theme' => 'dark']);
        ?>
        <table class="table">
            <tbody class="delivery-item-container">
            <?php foreach($itens as $item): ?>
                <tr class="delivery-item">
                    <td>
                        <a href="<?= url_to('delivery-item-remove', $item->id) ?>"><i class="icon ion-trash-b icon-badge text-bg-danger"></i></a>
                    </td>
                    <td>
                        <span class="delivery-item-name"><?= $item->name ?></span>
                    </td>
                    <td>
                        <span class="delivery-item-price"><?= price_format($item->price) ?></span>
                    </td>
                    <td>
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
                    </td>

                </tr>
            <?php endforeach ?>
            </tbody>
        </table>


        <?= form_submit(value: 'Salvar', extra: ['class' => 'btn btn-primary btn-block d-grid col-12 col-md-8 mx-auto m-3']) ?>
        <?= form_close(); ?>
    </div>

</div>
<?= $this->endSection(); ?>
