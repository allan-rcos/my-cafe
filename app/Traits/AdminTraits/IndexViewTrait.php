<?php

namespace App\Traits\AdminTraits;

use App\Enums\AdminViewEnum;
use App\Libraries\TableHandler;
use App\Models\Interface\IAdminModel;
use CodeIgniter\HTTP\RedirectResponse;

trait IndexViewTrait
{
    public function indexView(): RedirectResponse|string
    {
        $view = $this->validateConfig(AdminViewEnum::INDEX);
        if ($redirect = $this->checkPermission($view)) return $redirect;

        /** @var IAdminModel $model */
        $model = model($this->modelType);

        $page     = (int) ($this->request->getGet('page') ?? 1);
        $limit    = $this->request->getPost('limit')      ?? 10;
        $order_by = $this->request->getPost('order_by')   ?? 'id';
        $order    = $this->request->getPost('order')      ?? 'ASC';

        $products = $model->findAllTableData($limit, $order_by, $order);

        $pager = service('pager');
        $total = $model->count();

        // Call makeLinks() to make pagination links.
        $pager_links = $pager->makeLinks($page, $limit, $total);

        /** @var TableHandler $table_handler */
        $table_handler = service('table_handler');
        $table_handler->createTable($this->table_dir);
        $table_handler->setHeading($this->table_header);

        foreach ($products as $product) $table_handler->addRow($this->formatRow($product));

        $table_handler->setPaginator($pager_links);

        return view($this->views[$view], ['table' => $table_handler->generate()]);
    }

    protected function formatRow(array $row): array
    {
        return $row;
    }
}