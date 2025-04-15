<?php


namespace App\Controllers\Admin;

use App\Libraries\FileManager;
use App\Libraries\TableHandler;
use App\Models\CategoryModel;
use App\Traits\AdminTraits\IndexViewTrait;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ProductModel;
use Exception;

class Products extends AdminBaseController
{
    protected $permissions       = [ 'index'  => 'products.show' ];

    protected $permissionMessages = [ 'index'  => 'Você não tem permissão para visualizar Produtos' ];

    protected $views = [ 'index'  => 'admin/products/index' ];

    protected $modelType          = ProductModel::class;

    protected $table_dir          = 'products';
    protected $table_header       = [
        'id' => '#',
        'name' => 'Nome',
        'price' => 'Preço',
        'category' => 'Categoria',
        'description' => 'Descrição'
    ];

    protected $redirectRoute       = 'products';

    use IndexViewTrait;

    public function createView(): RedirectResponse | string
    {
        if (!Events::trigger('can', "products.create"))
            return redirect()->back()->with('error', 'Você não tem permissão para criar produtos.');
        $category_options = model(CategoryModel::class)->findAllSelect();
        return view('admin/products/form', [ 'category_options' => $category_options ]);
    }

    public function createAction(): RedirectResponse
    {
        if (!Events::trigger('can', "products.create"))
            return redirect()->back()->withInput()->with('error', 'Você não tem permissão para criar produtos.');

        /** @var FileManager $file_manager */
        $file_manager = service('file_manager');
        $upload_field_name = 'filename';
        if (!$this->validate($file_manager::getRules($upload_field_name)))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

        $model = model(ProductModel::class);

        $img = $this->request->getFile($upload_field_name);
        $data = $this->request->getPost();
        $data[$upload_field_name] = strtolower(str_replace(' ', '_', $data['name'])).'.'.$img->getExtension();

        if (!$model->validate($data))
            return redirect()->back()->withInput()->with('errors', $model->validation->getErrors());

        $file_manager::store($img, $data[$upload_field_name]);

        try {
            $model->insert($data);
            return redirect()->route('products')->with('message', 'Produto criado com sucesso!');
        } catch (Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }

    public function editView(int $id): string|RedirectResponse
    {
        if (!Events::Trigger('can', 'products.edit'))
            return redirect()->back()->with('error', 'Você não tem permissão para editar produtos.');

        $model = model(ProductModel::class);
        $category_options = model(CategoryModel::class)->findAllSelect();

        return view('admin/products/form', [
            'product' => $model->find($id),
            'category_options' => $category_options
        ]);
    }

    public function editAction(int $id): RedirectResponse
    {

        if (!Events::Trigger('can', 'products.edit'))
            return redirect()->back()->withInput()->with('error', 'Você não tem permissão para editar produtos.');

        /** @var ProductModel $model */
        $model = model(ProductModel::class);

        /** @var FileManager $file_manager */
        $file_manager = service('file_manager');

        $field_name = 'filename';
        $img = $this->request->getFile($field_name);
        $old = $model->find($id);
        $data = $this->request->getPost();
        $new_img = $img->hasMoved();
        if ($new_img)
            $data[$field_name] = $file_manager::filenameFormat($data['name']).'.'.$img->getExtension();

        if (!$model->validate($data, true))
            return redirect()->back()->withInput()->with('errors', $model->validation->getErrors());

        if ($new_img) {
            if (!$this->validate($file_manager::getRules($field_name)))
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());

            $file_manager::remove($old->filename);
            $file_manager::store($img, $data[$field_name]);
        }
        else if (array_key_exists('name', $data) && $data['name'] !== $old->name) {
            $filename = $file_manager::filenameFormat($data['name']).$file_manager::getExtension($old->filename);
            $file_manager::rename($old->filename, $filename);
        }

        try {
            $model->update($id, $data);
            return redirect()->route('products')->with('message', 'Produto editado com sucesso!');
        } catch (\Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }

    public function removeAction(int $id): RedirectResponse
    {
        if (!Events::Trigger('can', 'products.delete'))
            return redirect()->back()->with('error', 'Você não tem permissão para remover produtos.');

        $model = model(ProductModel::class);

        try {
            $product = $model->select(['id', 'filename'])->find($id);
            $model->delete($id);
            service('file_manager')::remove($product->filename);
            return redirect()->back()->with('message', 'Produto removido com sucesso!');
        } catch (\Exception $e) {
            return service('log')::unexpectedError($e);
        }
    }

    protected function formatRow(array $row): array
    {
        helper('format');

        $row['price'] = price_format($row['price']);
        return $row;
    }

}

