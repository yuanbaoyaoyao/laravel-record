<?php

namespace App\Http\Requests;

use App\Models\ProductSku;

class AddCartRequest extends Request
{
    public function rules()
    {
        return [
            'sku_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!$sku = ProductSku::find($value)) {
                        return $fail('该耗材不存在');
                    }
                    if (!$sku->product->in_warehouse) {
                        return $fail('该耗材未上架');
                    }
                    if ($sku->stock === 0) {
                        return $fail('该耗材已发完');
                    }
                    if ($this->input('amount') > 0 && $sku->stock < $this->input('amount')) {
                        return $fail('该耗材库存不足');
                    }
                },
            ],
            'amount' => ['required', 'integer', 'min:1'],
        ];
    }

    public function attributes()
    {
        return [
            'amount' => '耗材数量'
        ];
    }

    public function messages()
    {
        return [
            'sku_id.required' => '请选择耗材'
        ];
    }
}
