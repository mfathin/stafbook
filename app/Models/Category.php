<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'created_at',
        'updated_at',
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
