<?php
/**
 * @var string                                     $selected_category
 * @var Array<string,\App\Entities\CategoryEntity> $categories
 * @var \App\Entities\ProductEntity[]              $products
 */
?>

<?= $this->extend('main/layout') ?>

<?= $this->section('css') ?>
    <?= $this->include('partials/bg/products') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ['name' => 'Loja']) ?>

    <section class="row flex-column justify-content-center gap-5 min-vh-100">
        <div class="btn-group w-auto h-auto mx-auto d-block" role="group">
            <?php foreach ($categories as $id => $category) : ?>
                <input type="radio" class="btn-check" name="<?= $id ?>" id="btnradio<?= $id ?>"
                       autocomplete="off" <?= $id===$selected_category?"checked":"" ?>>
                <label class="btn btn-outline-primary" for="btnradio<?= $id ?>"><?= $category ?></label>
            <?php endforeach; ?>
        </div>
        <div class="row w-75 mx-auto d-flex">
            <?php foreach($products as $item): ?>
                <?= view('main/partials/product', ["product" => $item]) ?>
            <?php endforeach; ?>
        </div>
    </section>
<?= $this->endSection() ?>