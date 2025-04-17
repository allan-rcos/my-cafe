<?php
use App\Libraries\FileManager;

/** @var array $products */

helper('format');
$categories = [];
$dots = str_repeat('.', 150);
?>
<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ['name' => 'Menu']) ?>

    <?= $this->include('main/partials/book') ?>

    <section class="row w-75 mx-auto my-5">
        <div class="row min-vh-100 d-flex align-items-center justify-content-around row-gap-5">
            <?php for($i = 0; $i < count($products); $i++): ?>
                <?php $product = $products[$i]; ?>
                <?php if ($categories === [] || end($categories) !== $product['category_id']): ?>
                    <?php $categories[] = $product['category_id'] ?>
                    <div class="menu-col"> <!-- Div opened -->
                        <h5><?= $product['category'] ?></h5>
                <?php endif; ?>

                <div class="menu-item">
                    <img class="menu-item-image" alt="<?= $product['name'] ?>"
                         src="<?= FileManager::uriOrDefault($product['filename']??'')?>">
                    <div class="menu-item-container">
                        <div class="menu-item-row">
                            <p class="menu-item-name"><?= $product['name'] ?></p>
                            <p class="menu-item-dots"><?= $dots ?></p>
                            <p class="menu-item-value"><?= price_format($product['price']) ?></p>
                        </div>
                        <div class="menu-item-description">
                            <?= $product['description'] ?>
                        </div>
                    </div>
                </div>

                <?php if (!array_key_exists($i+1, $products) || $products[$i+1]['category_id'] !== end($categories)): ?>
                    </div> <!-- Div closed -->
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </section>
<?= $this->endSection() ?>
