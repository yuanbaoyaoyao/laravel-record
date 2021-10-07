<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'in_warehouse', 'sold_count'
    ];
    protected $casts=[
        'in_warehouse' => 'boolean',
    ];

    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }
}
