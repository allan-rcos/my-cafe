<?php
helper('format');
helper('form');
/**
 * @var \App\Entities\ProductEntity    $product
 * @var ?\App\Entities\ProductEntity[] $related
 */
?>
<?= $this->extend('main/layout') ?>

<?= $this->section('css') ?>
    <?= $this->include('partials/bg/product') ?> <!--bg-product-->
    <?= view('partials/bg/products', ['products' => $related]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <?= view('main/partials/header', ["name" => "Detalhes do Produto"]) ?>

    <section class="row vh-100 p-5">
        <div class="col bg-img bg-product"></div>
        <div class="col product-details">
            <h2><?= $product->name ?></h2>
            <h3><?= price_format($product->price) ?></h3>
            <?= "<p>$product->description</p>" ?>
            <?= form_open(url_to('add-to-cart', $product->id)) ?>
                <div class="form-group">
                    <label class="form-control-std">
                        <input name="quantity" type="number" placeholder=" ">
                        <span>Quantidade</span>
                    </label>
                </div>
                <div class="form-group ml-md-4 w-100 mt-1">
                    <input type="submit" value="Appointment" class="btn btn-primary w-100 py-3 px-4">
                </div>
            <?= form_close() ?>
        </div>
    </section>

    <?= (isset($related) && $related) ? view('main/partials/related', ["products" => $related]): '' ?>

<?= $this->endSection() ?>

