<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ShowBooking extends Component
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
        $item = Booking::latest()
            ->filter($this->search)
            ->paginate($this->paginate);

        $car = Item::all();
        $brand = Brand::all();
        $type = Type::all();
        return view('livewire.admin.show-booking', compact('item', 'brand', 'type', 'car'));
    }

    public function delete(int $id)
    {
        $item = Booking::find($id);

        $item->delete();

        $this->alert('success','Successfully Delete Item', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function deleteSelected()
    {
        if ($this->selected) {
            $item = Booking::whereKey($this->selected)->delete();

            $this->alert('success','Successfully Delete Selected Items', [
                'position' => 'top-end',
                'timer' => 5000,
                'width' => 420,
                'toast' => true,
                'timerProgressBar' => true,
            ]);

            $this->selected = [];
            $this->selectAll = false;
        } else {
            $this->alert('error', 'Failed to Delete Items', [
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
            $this->selected = Booking::pluck('id');
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
