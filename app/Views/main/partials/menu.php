<?php /** @var \App\Entities\ProductEntity[] $products */ ?>

<section class="row vh-100">
    <div class="col text-end d-flex align-items-center justify-content-end">
        <div class="w-75">
            <h2 class="mb-4 display-5 fw-bold">Nosso Menu:</h2>
            <p>
                No MyCafé, nosso menu é uma celebração de sabores e aromas,
                cuidadosamente elaborado para agradar a todos os paladares.
                Para acompanhar, oferecemos uma variedade de delícias caseiras:
                bolos fofinhos, pães de queijo quentinhos, sanduíches saborosos e muito mais.
                E para os dias mais quentes, nossos refrescantes cafés gelados e chás especiais são a pedida perfeita.
            </p>
            <a href="<?= url_to('menu') ?>" class="btn btn-outline-primary px-4 py-3">Ver Menu Completo</a>
        </div>
    </div>
    <div class="col col-md-6 d-flex align-items-center justify-content-start">
        <div class="row align-items-center w-75">
            <?php for($i = 0; $i < min(count($products), 4); $i++): ?>
                <div class="col-md-6 <?= $i % 2 === 0 ? 'mt-lg-5': '' ?>">
                    <a href="<?= url_to('product', $products[$i]->id) ?>">
                        <div class="bg-img <?= 'bg-product-'.$products[$i]->id ?>"></div>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
