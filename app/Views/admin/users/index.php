<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    <h2>Usuários</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">É Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data??[] as $item) { ?>
                <tr>
                    <th scope="row"><?= $item->id ?></th>
                    <td><?= $item->nome ?></td>
                    <td><?= $item->email ?></td>
                    <td><?= in_array("ADMIN", $item->roles) ? "Sim" : "Não" ?></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
<?= $this->endSection() ?>