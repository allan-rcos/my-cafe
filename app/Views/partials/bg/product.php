<style id="product-bg">
    <?php if(isset($product) && $product instanceof \App\Entities\ProductEntity): ?>
    .bg-product {
        background-image: url("<?= \App\Libraries\FileManager::uriOrDefault($product->filename); ?>");
    }
    <?php endif; ?>
</style>
