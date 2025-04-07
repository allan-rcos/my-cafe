<?php


namespace Tests\Support\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ProductModel;

class Products extends BaseController
{
    public function indexView(): RedirectResponse | string
    {
        $model = model(ProductModel::class);

        if (!auth()->user()->can('products.show'))
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar produtos.');

        $page = (int) ($this->request->getGet('page') ?? 1);
        $limit = $this->request->getPost('limit') ?? 10;
        $order_by = $this->request->getPost('order_by') ?? 'id';
        $order = $this->request->getPost('order') ?? 'ASC';

        $products = $model->findAllJoinWithCount($limit, $order_by, $order);

        $pager = service('pager');
        $perPage = $limit;
        $total   = $products[0]->count;

        // Call makeLinks() to make pagination links.
        $pager_links = $pager->makeLinks($page, $perPage, $total);

        return view('blank', ['products' => $products, 'pager' => $model->pager]);
    }
}

