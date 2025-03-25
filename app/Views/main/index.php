<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
    <section class="row vh-100 bg-img bg-img-attached bg-header-home">
        <div class="backdrop-filter-brightness-50 col-md-8 col-sm-12 text-center w-100 h-100 d-flex align-items-center justify-content-center flex-column">
                <h1 class="mb-4 fw-normal">A Melhor Experiência com Café</h1>
                <p class="mb-4 mb-md-5">Seu cantinho de sabor e aconchego. Cafés especiais, delícias caseiras e sorrisos sinceros.</p>
                <p>
                    <a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Peça agora</a>
                    <a href="#" class="btn btn-outline-primary p-3 px-xl-4 py-xl-3">Ver menú</a>
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
                <div class="col-3">
                    <a href="#">
                        <div class="bg-img bg-menu-1"></div>
                    </a>
                    <div class="text text-center pt-4">
                        <h4><a href="#">Espresso Tradicional</a></h4>
                        <p>Intenso e encorpado, para um despertar clássico.</p>
                        <p class="price">R$5,00</p>
                        <a href="#" class="btn btn-outline-primary">Adicionar ao carrinho.</a>
                    </div>
                </div>
                <div class="col-3">
                    <a href="#">
                        <div class="bg-img bg-menu-2"></div>
                    </a>
                    <div class="text text-center pt-4">
                        <h4><a href="#">Cappuccino Cremoso</a></h4>
                        <p>Equilíbrio perfeito entre café, leite e espuma.</p>
                        <p class="price">R$8,00</p>
                        <a href="#" class="btn btn-outline-primary">Adicionar ao carrinho.</a>
                    </div>
                </div>
                <div class="col-3">
                    <a href="#">
                        <div class="bg-img bg-menu-3"></div>
                    </a>
                    <div class="text text-center pt-4">
                        <h4><a href="#">Mocha Especial</a></h4>
                        <p>Chocolate e café, uma combinação irresistível.</p>
                        <p class="price">R$10,00</p>
                        <a href="#" class="btn btn-outline-primary">Adicionar ao carrinho.</a>
                    </div>
                </div>
                <div class="col-3">
                    <a href="#">
                        <div class="bg-img bg-menu-4"></div>
                    </a>
                    <div class="text text-center pt-4">
                        <h4><a href="#">Café Gelado Especial</a></h4>
                        <p>Refrescante, com toque especial da casa.</p>
                        <p class="price">R$12,00</p>
                        <a href="#" class="btn btn-outline-primary">Adicionar ao carrinho.</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?= $this->include('main/partials/menu') ?>

    <?= $this->include('main/partials/testimony') ?>
<?= $this->endSection() ?>