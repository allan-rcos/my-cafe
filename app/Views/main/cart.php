
<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ["Carrinho"]) ?>

    <section class="row min-vh-100">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Produto</th>
                <th scope="col">Preço</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php $totals = 0 ?>
            <?php foreach($cart??[] as $item) { ?>
                    <?php $totals += $total = $item["quantity"] * $item['value'] ?>
                <tr>
                    <td><a href="#"><i class="icon ion-close rounded-3 bg-primary flex-shrink-0 mx-5 me-2"></i></a></td>
                    <td><img src="<?= base_url('assets/images/'.($item['image_filename'])) ?>" alt="Imagem <?= $item['nome'] ?>"></td>
                    <td><span><?= $item["name"] ?></span><?= $item["description"] ?></td>
                    <td>R$<?= number_format($item['value'], 2, ',', '.') ?></td>
                    <td><?= $item["quantity"] ?></td>
                    <td>R$<?= number_format($total, 2, ',', '.') ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="cart-totals-container">
            <div class="cart-totals">
                <h5>Total do Carrinho:</h5>
                <div class="cart-totals-item">
                    <p class="cart-totals-key">Subtotal:</p>
                    <p class="cart-totals-value">R$<?= number_format($totals, 2, ',', '.') ?></p>
                </div>
                <div class="cart-totals-item">
                    <p class="cart-totals-key">Entrega:</p>
                    <p class="cart-totals-value">R$<?= number_format($delivery??0, 2, ',', '.') ?></p>
                </div>
                <div class="cart-totals-item">
                    <p class="cart-totals-key">Descontos:</p>
                    <p class="cart-totals-value">R$<?= number_format($disconts??0, 2, ',', '.') ?></p>
                </div>
                <div class="cart-totals-total-item">
                    <p class="cart-totals-key">Total:</p>
                    <p class="cart-totals-value">R$<?= number_format($totals + ($delivery??0) - ($disconts??0), 2, ',', '.') ?></p>
                </div>
            </div>
            <a href="#" class="btn btn-primary w-100 py-3 px-4">Prosseguir com a compra</a>
        </div>
        
    </section>

    <?= view('main/partials/related', ["data" => $data??[]]) ?>
<?= $this->endSection() ?>