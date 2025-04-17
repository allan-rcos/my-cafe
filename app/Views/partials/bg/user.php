<?php use App\Libraries\FileManager; ?>
<?php use App\Models\UserComplementModel; ?>
<style id="user-bg">
    <?php if($user = auth()->user()): ?>
    .bg-user {
        background-size: cover;
        background-image: url("<?= base_url(str_replace('\\', '/', FileManager::URI).'/'.(model(UserComplementModel::class)->findUser(auth()->user()->id)->photo)) ?>");
    }
    <?php else: ?>
    .bg-user {
        background-size: cover;
        background-image: url("https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/510px-Default_pfp.svg.png");
    }
    <?php endif; ?>
</style>