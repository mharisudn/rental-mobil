<?php

namespace App\Livewire\Admin;

use App\Models\Type;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ShowType extends Component
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
        $type = Type::latest()
            ->filter($this->search)
            ->paginate($this->paginate);
        return view('livewire.admin.show-type', [
            'type' => $type
        ]);
    }

    public function delete(int $id)
    {
        $type = Type::find($id);
        $type->delete();

        $this->alert('success','Successfully Delete Type', [
            'position' => 'top-end',
            'timer' => 5000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function deleteSelected()
    {
        if ($this->selected) {
            $type = Type::whereKey($this->selected)->delete();

            $this->alert('success','Successfully Delete Selected Types', [
                'position' => 'top-end',
                'timer' => 5000,
                'width' => 420,
                'toast' => true,
                'timerProgressBar' => true,
            ]);

            $this->selected = [];
            $this->selectAll = false;
        } else {
            $this->alert('error', 'Failed to Delete Types', [
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
            $this->selected = Type::pluck('id');
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
