<?php

use App\Libraries\FormHandler;

helper('form');
/** @var FormHandler $form_handler */
$form_handler = service('form_handler');
if (isset($item))
    $form_handler->setEntity($item);
?>

<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>

<div class="form-create">
    <h2><?= $form_handler->isEdit()?"Editar Categoria":"Adicionar Categoria" ?></h2>
    <?php
    echo validation_list_errors();
    echo form_open_multipart(current_url(), ['data-bs-theme' => 'dark']);

    echo $form_handler->getFloatingInput('Nome', 'name');
    echo $form_handler->getFloatingTextArea('Descrição', 'description');
    echo $form_handler->getSubmit();

    echo form_close();
    ?>
</div>
<?= $this->endSection(); ?>
