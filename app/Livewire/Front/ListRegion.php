<?php

namespace App\Livewire\Front;

use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use Livewire\Component;

class ListRegion extends Component
{
    public $province, $city = [], $district = [], $village = [];
    public $province_id = '', $city_id = '', $district_id = '' , $village_id = '';

    public function mount()
    {
        $this->province = Province::pluck('name', 'code');
        $this->city = $this->province_id ? City::where('province_code', $this->province_id)->pluck('name', 'code') : [];
        $this->district = $this->city_id ? District::where('city_code', $this->city_id)->pluck('name', 'code') : [];
        $this->village = $this->district_id ? village::where('district_code', $this->district_id)->pluck('name', 'code') : [];
    }

    public function render()
    {
        return view('livewire.front.list-region');
    }

    public function updatedProvinceId($val)
    {
        $this->city = City::where('province_code', $val)->pluck('name', 'code');
        $this->city_id = '';
        $this->district = [];
        $this->district_id = '';
        $this->village = [];
        $this->village_id = '';
    }

    public function updatedCityId($val)
    {
        $this->district = District::where('city_code', $val)->pluck('name', 'code');
        $this->district_id = '';
        $this->village = [];
        $this->village_id = '';
    }

    public function updatedDistrictId($val)
    {
        $this->village = Village::where('district_code', $val)->pluck('name', 'code');
        $this->village_id = '';
    }
}
