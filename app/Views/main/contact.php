<?= $this->extend('main/layout') ?>

<?= $this->section('content') ?>
    <?= view('main/partials/header', ['page_name' => 'Nossos Contatos', 'name' => 'Contatar']) ?>

    <section class="row vh-100 d-flex align-items-center w-75 mx-auto">
        <div class="col contacts">
            <h5>Informações de Contato: </h5>
            <p><span class="title">Endereço:</span> 1564 Shangrilá, Três Rios–RJ, Brasil</p>
            <p class="text-primary"><span class="title">Telefone:</span> +55 (01) 2345-6789 </p>
            <p class="text-primary"><span class="title">Email:</span> exemplo@<?= $_SERVER["SERVER_NAME"] ?> </p>
            <p class="text-primary"><span class="title">Website:</span> <?= site_url() ?> </p>
        </div>
        <div class="col contact-form">
            <form action="#" class="appointment-form">
                <div class="d-md-flex gap-3">
                    <div class="form-group">
                        <label class="form-control-std">
                            <input name="name" placeholder=" ">
                            <span>Nome</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="form-control-std">
                            <input name="email" placeholder=" ">
                            <span>Email</span>
                        </label>
                    </div>
                </div>
                <div class="d-md-flex gap-4">
                    <div class="form-group">
                        <label class="form-control-std">
                            <input placeholder=" ">
                            <span>Assunto </span>
                        </label>
                    </div>
                </div>
                <div class="d-md-flex">
                    <div class="flex-shrink-0 flex-grow-1">
                        <label class="form-control-std">
                            <textarea placeholder=" "></textarea>
                            <span>Mensagem</span>
                        </label>
                    </div>
                </div>
                <div class="d-md-flex">
                    <div class="form-group ml-md-4 w-100 mt-1">
                        <input type="submit" value="Appointment" class="btn btn-primary w-100 py-3 px-4">
                    </div>
                </div>
            </form>
        </div>
    </section>
<?= $this->endSection() ?>