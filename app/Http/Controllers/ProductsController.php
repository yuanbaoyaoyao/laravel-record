<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index(Request $request)
    {
        $builder = Product::query()->where('in_warehouse', true);
        if ($search = $request->input('search', '')) {
            $like = '%'.$search.'%';
            // 模糊搜索商品标题、商品详情、SKU 标题、SKU描述
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like) {
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }

        $products = $builder->paginate(10);

        return view('products.index', [
            'products' => $products,
            'filters'  => [
                'search' => $search,
            ],
        ]);
    }

    public function show(Product $product, Request $request)
    {
        if (!$product->in_warehouse) {
            throw new \Exception('耗材未在库');
        }

        return view('products.show', ['product' => $product]);
    }
}
