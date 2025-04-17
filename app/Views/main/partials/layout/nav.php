<?php use App\Libraries\FileManager; ?>
<?php use App\Models\UserComplementModel; ?>

<nav class="navbar navbar-expand-lg navbar-dark navbar-std bg-dark">
    <div class="mx-auto w-75 d-flex flex-row">
        <a class="navbar-brand py-3" href="<?= url_to('main-home') ?>">
            <img src="<?= base_url('assets/images/my_cafe_white.svg') ?>" alt="Logo" width="30" height="30" class="d-inline-block align-text-bottom">
            MyCafé
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= url_to('main-home') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url_to('about') ?>">Sobre Nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url_to('menu') ?>">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url_to('shop') ?>">Loja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= url_to('contact') ?>">Contatar</a>
                </li>
                <?php if($user = auth()->user()): ?>
                    <?php $user_complete = model(UserComplementModel::class)->findUser(auth()->user()->id); ?>
                    <li class="nav-item">
                        <div class="dropdown border-top">
                            <a href="#"
                               class="d-flex align-items-center justify-content-center p-3 link-dark
                                    text-decoration-none dropdown-toggle"
                               id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="bg-user rounded-circle" style="width: 48px; height: 48px;"></div>
                            </a>
                            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                                <li><a class="dropdown-item" href="<?= url_to('dashboard') ?>">Dashboard</a></li>
                                <?php if (service('authorize')->canAccessAdminHome()): ?>
                                    <li><a class="dropdown-item" href="<?= url_to('admin-home') ?>">Administrador</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= url_to('logout') ?>">Sair</a></li>
                            </ul>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item text-bg-primary">
                        <a class="nav-link" href="<?= url_to('login') ?>">Entrar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

</nav>