<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use function Laravel\Prompts\alert;

class ShowBrand extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $paginate = 10;
    public $search = "";
    public $selected = [];
    public $selectAll = false;
    public $title, $modelId;

    public function render()
    {
        $brand = Brand::latest()
            ->filter($this->search)
            ->paginate($this->paginate);
        return view('livewire.admin.show-brand', [
            'brand' => $brand
        ]);
    }

    public function delete(int $id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        $this->alert('success','Successfully Delete Brand', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function deleteSelected()
    {
        if ($this->selected) {
            $brand = Brand::whereKey($this->selected)->delete();

            $this->alert('success','Successfully Delete Selected Brands', [
                'position' => 'top-end',
                'timer' => 5000,
                'width' => 420,
                'toast' => true,
                'timerProgressBar' => true,
            ]);

            $this->selected = [];
            $this->selectAll = false;
        } else {
            $this->alert('error', 'Failed to Delete Brands', [
                'position' => 'top-end',
                'timer' => 5000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = Brand::pluck('id');
        } else {
            $this->selected = [];
        }
    }

    // Ressetting the page
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
