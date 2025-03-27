<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/svg" href="<?=base_url("assets/images/my_cafe.svg")?>">

    <title><?= $this->renderSection('title') ?></title>

    <?= $this->include('partials/fonts') ?>
    <?= $this->include('partials/stylesheet') ?>
    <?= $this->include('main/partials/layout/bg') ?>

    <?= $this->renderSection('pageStyles') ?>
</head>

<body class="bg-img bg-img-attached bg-page text-white fw-lighter min-vh-100">

    <main role="main" class="container" data-bs-theme="dark">
        <?= $this->renderSection('main') ?>
    </main>

    <?= $this->include('partials/javascript') ?>
    <?= $this->renderSection('pageScripts') ?>
</body>
</html>
