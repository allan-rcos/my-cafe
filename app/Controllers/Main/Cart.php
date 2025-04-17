<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use App\Models\DeliveryItemModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\RedirectResponse;
use Exception;

class Cart extends BaseController
{
    public function index(): RedirectResponse|string
    {
        if (!$user = auth()->user())
            return redirect()->route('login')->with('error', 'Usuário não está logado.');

        $cart = model(DeliveryItemModel::class)->findAllCart($user->id);
        $product_model = model(ProductModel::class);
        $related_limit = 4;

        if ($cart) {
            $categories = [];
            foreach ($cart as $item) $categories[] = $item['category_id'];
            $related = $product_model->whereIn('category_id', $categories)->findAll($related_limit);
        } else $related = $product_model->findAll($related_limit);

        return view('main/cart', [
            'cart'    => $cart,
            'related' => $related
        ]);
    }

    public function add(int $product_id): RedirectResponse
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->route('login')->with('error', 'Usuário não está logado.');
        if ($user->isNotActivated())
            return redirect()->back()->with('error', 'Apenas usuários verificados podem adicionar itens ao carrinho.');

        $model = model(DeliveryItemModel::class);
        $quantity = $this->request->getPost('quantity');
        $data = [
            'user_id'    => $user->id,
            'product_id' => $product_id,
            'quantity'   => $quantity
        ];

        if (!$model->validate($data))
            return redirect()->back()->withInput()->with('errors', $model->validation->getErrors());
        if ($model->where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->where('checked_at IS NULL')->find())
            return redirect()->back()->withInput()->with('error', 'Um produto não pode ser adicionado duas vezes ao carrinho.');

        try{
            $model->insert($data);
            return redirect()->back()->with('message', 'Produto Adicionado ao Carrinho com Sucesso!');
        } catch (Exception $e) {
            return service('log')::unespectedError($e);
        }
    }

    public function remove(int $product_id): RedirectResponse
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->route('login')->with('error', 'Usuário não está logado.');
        if ($user->isNotActivated())
            return redirect()->back()->with('error', 'Apenas usuários verificados podem remover itens do carrinho.');

        try {
            model(DeliveryItemModel::class)->where('user_id', $user->id)->where('product_id', $product_id)->delete();
            return redirect()->back()->with('message', 'Item removido com sucesso');
        } catch (Exception $e) {
            return service('log')::unespectedError($e);
        }
    }

    public function checkout(): RedirectResponse
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->route('login')->with('error', 'Usuário não está logado.');
        if ($user->isNotActivated())
            return redirect()->back()->with('error', 'Apenas usuários verificados podem adicionar itens ao carrinho.');

        try {
            model(DeliveryItemModel::class)->checkout($user->id);
            return redirect()->back()->with('message', 'Seu pedido foi gravado e será entregue.');
        } catch (Exception $e) {
            return service('log')::unespectedError($e);
        }
    }
}
