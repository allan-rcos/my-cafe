<?php use App\Libraries\FileManager; ?>
<style id="products-bg">
    <?php if(isset($products)): ?>
        <?php foreach($products as $product): ?>
            <?php
            if (is_array($product)) {
                if (!array_key_exists('id', $product))
                    continue;
                $className = 'bg-product-'.$product['id'];
                if (array_key_exists('filename', $product))
                    $url = FileManager::uriOrDefault($product['filename']);
                else
                    $url = FileManager::DEFAULT_IMAGE;
            } else if ($product instanceof \App\Entities\ProductEntity) {
                if (!$product->id)
                    continue;
                $className = 'bg-product-'.$product->id;
                if ($product->filename)
                    $url = FileManager::uriOrDefault($product->filename);
                else
                    $url = FileManager::DEFAULT_IMAGE;
            } else continue;
            ?>
    .<?= $className ?> {
        background-image: url("<?= $url; ?>");
    }
        <?php endforeach ?>
    <?php endif; ?>
</style>
