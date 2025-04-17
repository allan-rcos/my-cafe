<?php /** @var \App\Entities\ProductEntity $product */ ?>
<div class="product-item">
    <a href="<?= $link = url_to('product', $product->id) ?>">
        <div class="bg-img <?= 'bg-product-'.$product->id ?>"></div>
    </a>
    <div class="text text-center pt-4">
        <?php
        helper('format');

        if ($product->name)
            echo "<a href=\"$link\"><h4>$product->name</h4></a>";
        if ($product->description)
            echo "<p>$product->description</p>";
        if ($product->price)
            echo '<p class="price">'. price_format($product->price) .'</p>';
        if ($product->name || $product->description || $product->price)
            echo "<a href=\"$link\" class=\"btn btn-outline-primary\">Adicionar ao carrinho.</a>'"
        ?>
    </div>
</div>
