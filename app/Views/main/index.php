<?php
/** @var \App\Entities\ProductEntity[] $products */

helper('format');
?>

<?= $this->extend('main/layout') ?>

<?= $this->section('css') ?>
    <?= $this->include('partials/bg/products') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="row vh-100 bg-img bg-img-attached bg-header-home">
        <div class="backdrop-filter-brightness-50 col-md-8 col-sm-12 text-center w-100 h-100 d-flex align-items-center justify-content-center flex-column">
                <h1 class="mb-4 fw-normal">A Melhor Experiência com Café</h1>
                <p class="mb-4 mb-md-5">Seu cantinho de sabor e aconchego. Cafés especiais, delícias caseiras e sorrisos sinceros.</p>
                <p>
                    <a href="<?= url_to('shop') ?>" class="btn btn-primary p-3 px-xl-4 py-xl-3">Peça agora</a>
                    <a href="<?= url_to('menu') ?>" class="btn btn-outline-primary p-3 px-xl-4 py-xl-3">Ver menú</a>
                </p>
        </div>

    </section>

    <?= $this->include('main/partials/book') ?>

    <?= $this->include('main/partials/story') ?>

    <section class="row bg-brown vh-100 py-5">
        <div class="container my-auto">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 text-center">
                    <h2 class="mb-4 display-5 fw-bold"> Melhores Cafés </h2>
                    <p>
                        Descubra nossa seleção exclusiva dos cafés mais apreciados, escolhidos a dedo por nossos clientes.
                        De grãos aromáticos a blends encorpados, cada um oferece uma experiência única e inesquecível.
                    </p>
                </div>
            </div>
            <div class="row mx-auto w-75">
                <?php foreach($products as $product): ?>
                    <div class="col-3">
                        <a href="<?= $url = url_to('product', $product->id) ?>">
                            <div class="bg-img <?= 'bg-product-'.$product->id ?>"></div>
                        </a>
                        <div class="text text-center pt-4">
                            <h4><a href="<?= $url ?>"><?= $product->name ?></a></h4>
                            <p><?= $product->description ?></p>
                            <p class="price"><?= price_format($product->price) ?></p>
                            <a href="<?= $url ?>" class="btn btn-outline-primary">Adicionar ao carrinho.</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <?= view('main/partials/menu', ['products' => $products]) ?>

    <?= $this->include('main/partials/testimony') ?>
<?= $this->endSection() ?>