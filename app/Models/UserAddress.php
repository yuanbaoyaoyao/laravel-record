<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;

    protected $fillable = [
      'department',
      'user',
      'contact_phone',
      'last_used_at',
    ];
    protected $dates = ['last_used_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->department}{$this->user}{$this->contact_phone}";
    }
}
