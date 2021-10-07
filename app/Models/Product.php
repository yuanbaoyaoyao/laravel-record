<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function getImageUrlAttribute()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk('public')->url($this->attributes['image']);
    }
}
