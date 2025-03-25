
<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ["name" => "Login"]) ?>
    <section class="row min-vh-100 align-items-center justify-content-center">
        <div class="col">
            <div class="form-container">
                <h3>Login</h3>
            </div>
            <form action="">
                <label class="form-control-std">
                    <input type="email" name="email" placeholder=" ">
                    <span>Email</span>
                </label>
                <label class="form-control-std">
                    <input type="password" name="password" placeholder=" ">
                    <span>Senha</span>
                </label>
                <input type="submit" class="btn btn-primary w-100 py-3 px-4 ml-md-4 mt-1">
            </form>
        </div>
    </section>
<?= $this->endSection() ?>


