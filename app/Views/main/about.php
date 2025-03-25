<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ['name' => 'Sobre Nós']) ?>

    <?= $this->include('main/partials/story') ?>

    <?= $this->include('main/partials/testimony') ?>
<?= $this->endSection() ?>