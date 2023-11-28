<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Item;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ShowItem extends Component
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
        $item = Item::latest()
            ->filter($this->search)
            ->paginate($this->paginate);

        $brand = Brand::all();
        $type = Type::all();
        return view('livewire.admin.show-item', compact('item', 'brand', 'type'));
    }

    public function delete(int $id)
    {
        $item = Item::find($id);

        // Delete array files from storage
        $photos = json_decode($item->photos);
        foreach ($photos as $photo) {
            Storage::disk('public')->delete($photo);
        }

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
            $item = Item::whereKey($this->selected)->delete();

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
            $this->selected = Item::pluck('id');
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
