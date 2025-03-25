<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ['name' => 'Menu']) ?>

    <?= $this->include('main/partials/book') ?>

    <section class="row w-75 mx-auto d-flex gap-5 my-5">
        <?php for($i = 0; $i < 2; $i++) { ?>
            <div class="row 100vh d-flex align-items-center justify-content-around">
                <?php for($j = 0; $j < 2; $j++) { ?>
                    <div class="menu-col">
                        <h5>Starter</h5>
                        <?php for ($k = 0; $k < 5; $k++) { ?>
                            <div class="menu-item">
                                <img class="menu-item-image" alt="" src="<?= base_url("assets/images/menu_1.jpg") ?>">
                                <div class="menu-item-container">
                                    <div class="menu-item-row">
                                        <p class="menu-item-name">Nome do Item</p>
                                        <p class="menu-item-dots"><?= str_repeat('.', 150) ?></p>
                                        <p class="menu-item-value">R$100,00</p>
                                    </div>
                                    <div class="menu-item-description">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </section>
<?= $this->endSection() ?>
