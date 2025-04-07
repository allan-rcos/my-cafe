<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\TableHandler;
use App\Models\CategoryModel;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class Categories extends BaseController
{
    public function indexView(): string | RedirectResponse
    {
        if (!Events::trigger('can', "category.show"))
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar categorias.');

        $model = model(CategoryModel::class);

        $limit = $this->request->getPost('limit') ?? 10;
        $order_by = $this->request->getPost('order_by') ?? 'id';
        $order = $this->request->getPost('order') ?? 'ASC';

        $categories = $model->asArray()->orderBy($order_by, $order)->paginate($limit);

        /** @var TableHandler $table_handler */
        $table_handler = service('table_handler');
        $table_handler->createTable('categories');
        $table_handler->setHeading(['id' => '#', 'name' => 'Nome', 'description' => 'Descrição']);

        foreach ($categories as $category) $table_handler->addRow($category);

        $table_handler->setPaginator($model->pager->links());

        return view('admin/categories/index', ['table' => $table_handler->generate()]);
    }

    public function createView(): string | RedirectResponse
    {
        if (!Events::trigger('can', "category.create"))
            return redirect()->back()->with('error', 'Você não tem permissão para criar categorias.');

        return view('admin/categories/form');
    }

    public function createAction(): RedirectResponse
    {
        if (!Events::trigger('can', "category.create"))
            return redirect()->back()->withInput()->with('error', 'Você não tem permissão para criar categorias.');

        $model = model(CategoryModel::class);
        $data = $this->request->getPost();

        if (!$model->validate($data))
            return redirect()->back()->withInput()->with('errors', $model->validation->getErrors());
        try {
            $model->insert($data);
            return redirect()->route('categories')->with('message', 'Categoria criada com sucesso.');
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }

    public function editView(int $id): string | RedirectResponse
    {
        if (!Events::trigger('can', "category.edit"))
            return redirect()->back()->with('error', 'Você não tem permissão para editar categorias.');

        return view('admin/categories/form', ['category' => model(CategoryModel::class)->find($id)]);
    }

    public function editAction(int $id): RedirectResponse
    {
        if (!Events::Trigger('can', 'category.edit'))
            return redirect()->back()->withInput()->with('error', 'Você não tem permissão para editar categorias.');

        $model = model(CategoryModel::class);
        $data = $this->request->getPost();
        $category = $model->asArray()->find($id);
        foreach (array_keys($data) as $key)
            if ($category[$key] === $data[$key]) unset($data[$key]);

        if (!$model->validate($data, true))
            return redirect()->back()->withInput()->with('errors', $model->validation->getErrors());

        try {
            $model->update($id, $data);
            return redirect()->route('categories')->with('message', 'Categoria Editada com Sucesso!');
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }

    public function removeAction($id): RedirectResponse
    {
        if (Events::Trigger('can', 'category.delete'))
            return redirect()->back()->with('error', 'Você não tem permissão para remover categorias.');

        try {
            model(CategoryModel::class)->delete($id);
            return redirect()->back()->with('message', 'Categoria Removida com Sucesso!');
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }
}
