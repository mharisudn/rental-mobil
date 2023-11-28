<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'address',
        'province_code',
        'city_code',
        'district_code',
        'village_code',
        'status',
        'payment_method',
        'payment_url',
        'payment_status',
        'amount',
        'item_id',
        'user_id'
    ];

    // Attribute casting
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_code','code');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_code','code');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_code','code');
    }

    public function village()
    {
        return $this->belongsTo(Village::class,'village_code','code');
    }

    public function scopeFilter($query, $search)
    {
        $query->when($search ?? false, function($query, $search) {
            return $query->where('name', 'like', "%$search%");
        });
    }
}
