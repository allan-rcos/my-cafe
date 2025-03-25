<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>

    <?= view('main/partials/header', ["name" => "Detalhes do Produto"]) ?>

    <section class="row vh-100">
        <div class="col bg-img" style="background-image: url('<?= base_url('assets/images/'.($image_filename??"")) ?>')"> </div>
        <div class="col product-details">
            <h2><?= $name??"Nome do Produto" ?></h2>
            <h3><?= number_format($value??5., 2, ",", ".") ?></h3>
            <p><?= $description??"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut corporis eius est illum
            itaque iusto libero mollitia necessitatibus numquam optio qui quia, similique sit sunt temporibus tenetur
            unde veniam, voluptatum? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid asperiores
            aspernatur at distinctio exercitationem expedita fugit hic magnam, nostrum officia, repudiandae velit
            voluptates! Cumque deserunt doloremque, explicabo magnam nesciunt quae.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut corporis eius est illum
            itaque iusto libero mollitia necessitatibus numquam optio qui quia, similique sit sunt temporibus tenetur
            unde veniam, voluptatum? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid asperiores
            aspernatur at distinctio exercitationem expedita fugit hic magnam, nostrum officia, repudiandae velit
            voluptates! Cumque deserunt doloremque, explicabo magnam nesciunt quae.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut corporis eius est illum
            itaque iusto libero mollitia necessitatibus numquam optio qui quia, similique sit sunt temporibus tenetur
            unde veniam, voluptatum? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid asperiores
            aspernatur at distinctio exercitationem expedita fugit hic magnam, nostrum officia, repudiandae velit
            voluptates! Cumque deserunt doloremque, explicabo magnam nesciunt quae." ?> </p>
            <form action="">
                <select class="form-select" aria-label="Default select example">
                    <option value="0" selected>Pequeno</option>
                    <option value="1">Médio</option>
                    <option value="2">Grande</option>
                    <option value="3">Extra-Grande</option>
                </select>
                <div class="form-group">
                    <label class="form-control-std">
                        <input name="name" type="number" placeholder=" ">
                        <span>Quantidade</span>
                    </label>
                </div>
                <div class="form-group ml-md-4 w-100 mt-1">
                    <input type="submit" value="Appointment" class="btn btn-primary w-100 py-3 px-4">
                </div>
            </form>
        </div>
    </section>

    <?= view('main/partials/related', ["data" => $data??[]]) ?>

<?= $this->endSection() ?>

