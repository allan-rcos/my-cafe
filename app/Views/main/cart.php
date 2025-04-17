<?php helper('format') ?>
<?php /** @var array $cart */ ?>
<?php /** @var \App\Entities\ProductEntity[] $related */ ?>

<?= $this->extend('main/layout') ?>

<?= $this->section('css') ?>
    <?= view('partials/bg/products', ['products' => $related]) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ["Carrinho"]) ?>

    <section class="row min-vh-100 align-items-center">
        <table class="table cart-table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="text-center">Produto</th>
                <th scope="col">Preço</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $totals = 0 ?>
            <?php foreach($cart as $item) { ?>
                <?php $totals += $total = $item["quantity"] * $item['price'] ?>
                <tr>
                    <td>
                        <a href="<?= url_to('remove-from-cart', $item['product_id']) ?>">
                            <i class="icon ion-close rounded-3 bg-primary text-white flex-shrink-0 mx-5 me-2"></i></a>
                    </td>
                    <td>
                        <img src="<?= \App\Libraries\FileManager::uriOrDefault($item['filename']) ?>"
                             style="max-height: 6rem; max-width: 6rem;"
                             alt="Imagem <?= $item['name'] ?>">
                    </td>
                    <td class="text-center"><span><?= $item["name"] ?></span><br><?= $item["description"] ?></td>
                    <td ><?= price_format($item['price']) ?></td>
                    <td><?= $item["quantity"] ?></td>
                    <td><?= price_format($total) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="cart-totals-container">
            <div class="cart-totals">
                <div class="cart-totals-total-item">
                    <p class="cart-totals-key">Total do Carrinho:</p>
                    <p class="cart-totals-value"><?= price_format($totals) ?></p>
                </div>
            </div>
            <a href="<?= $cart?url_to('checkout'):'#' ?>"
               class="btn btn-primary w-100 py-3 px-4 <?= $cart?'':'disabled' ?>">
                Prosseguir com a compra
            </a>
        </div>
        
    </section>

    <?= view('main/partials/related', ["products" => $related]) ?>
<?= $this->endSection() ?>