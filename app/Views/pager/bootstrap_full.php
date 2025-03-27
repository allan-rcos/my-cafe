<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination">
        <?php $hasPrevious = $pager->hasPrevious() ?>
        <li class="page-item <?= $hasPrevious?'':'disabled' ?>">
            <a class="page-link" href="<?= $hasPrevious?$pager->getFirst():'' ?>" aria-label="<?= lang('Pager.first') ?>">
                <span aria-hidden="true"><?= lang('Pager.first') ?></span>
            </a>
        </li>
        <li class="page-item <?= $hasPrevious?'':'disabled' ?>">
            <a class="page-link" href="<?= $hasPrevious?$pager->getPrevious():'' ?>" aria-label="<?= lang('Pager.previous') ?>">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>" >
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php $hasNext = $pager->hasNext(); ?>
        <li class="page-item <?= $hasNext?'':'disabled' ?>">
            <a class="page-link" href="<?= $hasNext?$pager->getNext():'' ?>" aria-label="<?= lang('Pager.next') ?>">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <li class="page-item <?= $hasNext?'':'disabled' ?>">
            <a class="page-link" href="<?= $hasNext?$pager->getLast():'' ?>" aria-label="<?= lang('Pager.last') ?>">
                <span aria-hidden="true"><?= lang('Pager.last') ?></span>
            </a>
        </li>
    </ul>
</nav>
