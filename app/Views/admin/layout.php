<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>MyCafé</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/svg" href="<?=base_url("assets/images/my_cafe.svg")?>">

        <?=$this->include('partials/fonts')?>

        <?= $this->include('partials/stylesheet') ?>
        <?= $this->renderSection("css") ?>
    </head>
    <body class="bg-img bg-img-attached bg-page fw-lighter">
        <?= $this->include('admin/partials/sidebar')?>
        <main class="container" style="margin-left: 4.5rem;">
            <?= $this->renderSection("content") ?>
        </main>

        <?= $this->include('partials/loader') ?>

        <?= $this->include('partials/javascript')?>
        <?= $this->renderSection('javascript') ?>
    </body>
</html>