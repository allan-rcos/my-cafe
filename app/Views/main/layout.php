<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>MyCafé</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/svg" href="<?=base_url("assets/images/my_cafe.svg")?>">

        <?=$this->include('partials/fonts')?>

        <?= $this->include('partials/stylesheet') ?>
        <?= $this->include('partials/bg/user') ?>
        <?= $this->renderSection("css") ?>
        <?= $this->include('main/partials/layout/bg') ?>
    </head>
    <body class="bg-img bg-img-attached bg-page text-white fw-lighter">
        <?= $this->include('main/partials/layout/nav')?>
        <main class="container-fluid">
            <?= $this->renderSection("content") ?>
        </main>

        <?= $this->include('main/partials/layout/footer') ?>

        <?= $this->include('partials/loader') ?>

        <?= $this->include('partials/javascript')?>
        <?= $this->renderSection('javascript') ?>
    </body>
</html>