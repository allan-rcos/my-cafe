<?php

use CodeIgniter\Shield\Entities\User;
if (current_url(true)->getSegment(3) === 'edit') {
    /** @var $user User */
    $is_edit = true;
    $id = current_url(true)->getSegment(4);
} else {
    /** @var $user null */
    $is_edit = false;
}

?>
<?= $this->extend('admin/layout'); ?>

<?= $this->section('content'); ?>
    <h2><?= $is_edit?"Editar Usuário":"Adicionar Usuário" ?></h2>
    <div class="form-create">
        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
        <?php elseif (session('errors') !== null) : ?>
            <div class="alert alert-danger" role="alert">
                <?php if (is_array(session('errors'))) : ?>
                    <?php foreach (session('errors') as $error) : ?>
                        <?= $error ?>
                        <br>
                    <?php endforeach ?>
                <?php else : ?>
                    <?= session('errors') ?>
                <?php endif ?>
            </div>
        <?php endif ?>

        <?php if (session('message') !== null) : ?>
            <div class="alert alert-success" role="alert"><?= session('message') ?></div>
        <?php endif ?>

        <form action="<?php if($is_edit) echo url_to('user-edit', $id); else echo url_to('user-create'); ?>"
              method="post" autocomplete="off" data-bs-theme="dark" novalidate>
            <?= csrf_field() ?>

            <!-- Email -->
            <?php
            $email = '';
            if (old('email') !== null) $email = old('email');
            else if ($is_edit) $email = $user->email;
            ?>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" placeholder="<?= lang('Auth.email') ?>" value="<?= $email ?>" required>
                <label for="floatingEmailInput"><?= lang('Auth.email') ?></label>
            </div>

            <!-- Username -->
            <?php
            $username = '';
            if (old('username') !== null) $username = old('username');
            else if ($is_edit) $username = $user->username;
            ?>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingUsernameInput" name="username" inputmode="text" autocomplete="username" placeholder="<?= lang('Auth.username') ?>" value="<?= $username ?>" required>
                <label for="floatingUsernameInput"><?= lang('Auth.username') ?></label>
            </div>

            <!-- Password -->
            <div class="form-floating mb-3">
                <input type="password" class="form-control" autocomplete="new-password" id="floatingPasswordInput" name="password" inputmode="text" placeholder="<?= lang('Auth.password') ?>" required>
                <label for="floatingPasswordInput"><?= lang('Auth.password') ?></label>
            </div>
            <?php if (auth()->user()->can('admin.manage')): ?>
                <h6>Grupos:</h6>
                <?php
                $user_groups = $is_edit?$user->getGroups():[];
                $groups = setting('AuthGroups.groups');
                unset($groups['user']);
                ?>
                <?php foreach($groups as $key => $item): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="group_<?= $key ?>" id="flexCheckDefault"
                                <?php if ($is_edit && $user_groups) if (in_array($key, $user_groups)) echo 'checked';
                                    if (old('group_'.$key)) echo 'checked' ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                            <strong class="text-primary"><?= $item['title']; ?>: </strong> <?= $item['description'] ?>
                        </label>
                    </div>
                <?php endforeach ?>

                <h6>Permissões:</h6>
                <?php
                $user_permissions = $is_edit?$user->getPermissions():[];
                $permissions = setting('AuthGroups.permissions');
                ?>
                <?php foreach($permissions as $key => $description): ?>
                    <?php $key_name = str_replace('.', '-', $key); ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission_<?= $key_name ?>" id="flexCheckDefault"
                            <?php if ($is_edit && $user_permissions) if (in_array($key, $user_permissions)) echo 'checked';
                                if (old('permission_'.$key_name)) echo 'checked'; ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                            <strong class="text-primary"><?= $key_name; ?>: </strong> <?= $description ?>
                        </label>
                    </div>
                <?php endforeach ?>

                <?php
                $checked = false;
                if (old('active') !== null) $checked = old('active');
                else if ($is_edit) $checked = $user->isActivated();
                ?>
                <div class="form-check mt-2">
                    <label class="form-check-label">
                        <input type="checkbox" name="active" class="form-check-input" <?php if ($checked): ?> checked<?php endif ?>>
                        Ativo.
                    </label>
                </div>
            <?php endif; ?>

            <div class="d-grid col-12 col-md-8 mx-auto m-3">
                <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            </div>

        </form>
    </div>
<?= $this->endSection(); ?>
