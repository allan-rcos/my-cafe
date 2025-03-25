<div class="product-item">
    <a href="#">
        <div class="bg-img" style="background-image: url('<?= base_url('assets/images/'.($image_filename??'')) ?>')"></div>
    </a>
    <div class="text text-center pt-4">
        <a href="#"><h4><?= $name??"Espresso Tradicional" ?></h4></a>
        <p><?= $description??"Intenso e encorpado, para um despertar clássico." ?></p>
        <p class="price">R$<?= number_format($value??5., 2, ",", ".") ?></p>
        <a href="#" class="btn btn-outline-primary">Adicionar ao carrinho.</a>
    </div>
</div>
