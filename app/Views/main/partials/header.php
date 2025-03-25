<header class="row vh-100 bg-img bg-img-attached bg-header">
    <div class="backdrop-filter-brightness-50 col-md-8 col-sm-12 text-center w-100 h-100 d-flex align-items-center
            justify-content-center flex-column">
        <h1 class="mb-4 fw-normal"><?= $page_name??$name??"Nome" ?></h1>
        <p class="d-flex gap-3">
            <a href="<?= url_to('home') ?>"
               class="link-offset-3 fw-normal link-opacity-75 link-underline link-underline-opacity-25">
                Home
            </a>
            <a href="<?= $link??'#' ?>"
               class="link-offset-3 fw-normal link-opacity-75 link-underline link-underline-opacity-25">
                <?= $name??"Nome" ?>
            </a>
        </p>
    </div>
</header>