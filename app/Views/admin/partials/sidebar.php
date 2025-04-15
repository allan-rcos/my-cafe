<?php

use App\Models\UserComplementModel;
use App\Libraries\FileManager;

?>
<div class="d-flex flex-column vh-100 flex-shrink-0 bg-brown position-absolute left-0 top-0" style="width: 4.5rem;">
    <a href="/" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
        <img src="<?= base_url('assets/images/my_cafe_white.svg') ?>" alt="Logo" width="40" height="40" class="d-inline-block align-text-bottom">
        <span class="visually-hidden">MyCafé - Admin</span>
    </a>
    <?php $links = [
        [
            "url" => url_to('admin-home'),
            "icon" => "ion-home",
            "title" => "Home"
        ],
        [
            "url" => url_to('books'),
            "icon" => "ion-calendar",
            "title" => "Reservas"
        ],
        [
            "url" => url_to('delivery'),
            "icon" => "ion-pin",
            "title" => "Pedidos"
        ],
        [
            "url" => url_to('products'),
            "icon" => "ion-coffee",
            "title" => "Produtos"
        ],
        [
            "url" => url_to('categories'),
            "icon" => "ion-pound",
            "title" => "Categoria"
        ],
        [
            "url" => url_to('users'),
            "icon" => "ion-person",
            "title" => "Usuários"
        ]
    ]; ?>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <?php foreach($links as $link) { ?> <!-- TODO: Add "active" class and "aria-current="page"" -->
            <li class="nav-item">
                <a href="<?= $link['url'] ?>" class="nav-link py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="<?= $link['title'] ?>">
                    <i class="icon <?= $link['icon'] ?> fs-3"></i>
                </a>
            </li>
        <?php } ?>
    </ul>
    <div class="dropdown border-top">
        <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= base_url(str_replace('\\', '/', FileManager::URI).'/'.(model(UserComplementModel::class)->findUser(auth()->user()->id)->photo)) ?>"
                 alt="mdo" width="24" height="24" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3" style="">
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>