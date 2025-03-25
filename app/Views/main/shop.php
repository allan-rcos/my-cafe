<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ['name' => 'Loja']) ?>

    <section class="row flex-column justify-content-center gap-5 min-vh-100">
        <div class="btn-group w-auto h-auto mx-auto d-block" role="group">
            <?php for($i = 0; $i < 3; $i++) { ?>
                <input type="radio" class="btn-check" name="btnradio<?= $i ?>" id="btnradio<?= $i ?>" autocomplete="off" <?= $i===0?"checked":"" ?>>
                <label class="btn btn-outline-primary" for="btnradio<?= $i ?>">Radio <?= $i ?></label>
            <?php } ?>
        </div>
        <div class="row w-75 mx-auto d-flex">
            <?php foreach($data??[] as $item) { ?>
                <?= view('main/partials/product', $item) ?>
            <?php } ?>
        </div>
    </section>
<?= $this->endSection() ?>