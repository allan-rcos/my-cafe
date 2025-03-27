<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>MyCafé</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/svg" href="<?=base_url("assets/images/my_cafe.svg")?>">

        <?=$this->include('partials/fonts')?>

        <?= $this->include('partials/stylesheet') ?>
        <?= $this->include('main/partials/layout/bg') ?>
        <?= $this->renderSection("css") ?>
    </head>
    <body class="bg-img bg-img-attached bg-page fw-lighter text-white">
        <?= $this->include('admin/partials/sidebar')?>
        <main class="container-fluid w-auto vh-100 px-4 py-5 overflow-y-auto" style="margin-left: 4.5rem;" data-bs-theme="dark">
            <?= $this->renderSection("content") ?>
        </main>

        <?= $this->include('partials/loader') ?>

        <?= $this->include('partials/javascript')?>
        <?= $this->renderSection('javascript') ?>
    </body>
</html>