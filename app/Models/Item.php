<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'type_id',
        'features',
        'price',
        'star',
        'review',
        'photos'
    ];

    // Attribute casting
    protected $casts = [
        'photos' => 'array',
    ];

    // Get first photo from photos
    public function getThumbnailAttribute()
    {
        if ($this->photos) {
            return Storage::url(json_decode($this->photos)[0]);
        }

        return 'https://via.placeholder.com/800x600';
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeFilter($query, $search)
    {
        $query->when($search ?? false, function($query, $search) {
            return $query->where('name', 'like', "%$search%");
        });
    }
}
