<?php /** @var \App\Entities\ProductEntity[] $products */ ?>

<section class="row bg-brown vh-100 py-5">
    <div class="container my-auto">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 text-center">
                <h2 class="mb-4 display-5 fw-bold"> Produtos Relacionados </h2>
                <p>
                    Descubra nossa seleção exclusiva dos cafés mais apreciados, escolhidos a dedo por nossos clientes.
                </p>
            </div>
        </div>
        <div class="row w-75 mx-auto d-flex">
            <?php foreach($products as $product) { ?>
                <?= view('main/partials/product', ['product' => $product]) ?>
            <?php } ?>
        </div>
    </div>
</section>
