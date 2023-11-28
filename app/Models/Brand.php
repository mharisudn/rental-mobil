<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function scopeFilter($query, $search)
    {
        $query->when($search ?? false, function($query, $search) {
            return $query->where('name', 'like', "%$search%");
        });
    }

}
