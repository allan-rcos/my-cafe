<?php

use App\Entities\CompleteUserEntity;
use App\Libraries\FormHandler;

/**
 * @var CompleteUserEntity $user
 * @var string             $group
 * @var string[]           $permissions
 * @var FormHandler        $form_handler
 */

$form_handler = service('form_handler');
$form_handler->setEntity($user);
?>
<?= $this->extend('auth/layout') ?>

<?= $this->section('title') ?> Dashboard <?= $this->endSection() ?>

<?= $this->section('main') ?>
    <div class="container d-flex justify-content-center p-5 dashboard-container">
        <div class="card col-12 col-md-5 shadow-sm">
            <div class="card-body">
                <?= form_open_multipart(current_url(), ['data-bs-theme' => 'dark']); ?>
                <div class="user-dashboard-photo">
                    <?= $form_handler->getUpload($group, 'photo', 'badge text-bg-primary') ?>
                </div>
                <div>
                    <div class="mb-3"> <?=
                        join(' ',
                            array_map(
                                static function (string $value) {
                                    return "<span class='badge text-bg-success'>$value</span>";
                                },
                                $permissions
                            )
                        ); ?> </div>
                    <?php
                    if($errors = $form_handler->getErrors())
                        echo "<div class=\"mb-3\">".$errors."</div>";
                    ?>
                    <?= $form_handler->getFloatingInput('Nome de Usuário', 'username', required:false, disabled:true) ?>
                    <?= $form_handler->getFloatingInput('Email', 'email', required: false, disabled:true) ?>
                    <?= $form_handler->getFloatingInput('Nome Completo', 'name') ?>
                    <?= $form_handler->getFloatingInput('Telefone', 'phone') ?>
                    <?= $form_handler->getFloatingInput('Endereço Completo', 'address') ?>

                </div>
                <?= $form_handler->getSubmit(); ?>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>