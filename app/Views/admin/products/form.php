<?php

use App\Libraries\FormHandler;

helper('form');
/** @var FormHandler $form_handler
  * @var array<string, string> $category_options */
$form_handler = service('form_handler');
if (isset($product))
    $form_handler->setEntity($product);
?>

<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>

<div class="form-create">
    <?php

    echo $form_handler->getErrors();

    echo form_open_multipart(current_url(), ['data-bs-theme' => 'dark']);
    echo '<div class="card mb-3"> <div class="row g-0">';
        echo '<div class="col-md-4">';
            echo $form_handler->getUpload('Selecione uma Imagem.', 'filename');
        echo "</div>";
        echo '<div class="col-md-8 p-4">';
            echo '<h2 class="ms-1 mb-3">'.($form_handler->isEdit()?"Editar Produto":"Adicionar Produto").'</h2>';
            echo $form_handler->getFloatingInput('Nome', 'name');
            echo $form_handler->getFloatingInput('Preço', 'price', 'number');
            echo $form_handler->getFloatingSelect('Selecione uma Categoria', 'category_id', $category_options);
            echo $form_handler->getFloatingTextArea('Descrição', 'description');
            echo $form_handler->getSubmit();
        echo '</div>';
    echo '</div> </div>';

    echo form_close();
    ?>
</div>
<?= $this->endSection(); ?>
