<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;
    public $active;
    public $search;
    public $sortBy = 'id';
    public $sortAsc = true;

    public $confirmingItemDeletion;
    public $itemDeleted;

    public $confirmingItemAddition;
    public $itemAdd;

    public $name;
    public $price;
    public $status;

    protected $queryString = [
        'active'  => ['except' => false],
        'search'  => ['except' => ''],
        'sortBy'  => ['except' => 'id'],
        'sortAsc' => ['except' => true],
    ];

    protected $rules = [
        'name'  => 'required|string|min:4|max:50',
        'price' => 'required|numeric|between:1,100',
        'status'  => 'boolean' ,
    ];


    public function render()
    {
        $items = Item::where('user_id', '=', Auth::id())
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('price', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->active, function ($query) {
                return $query->active();
            })->orderBy($this->sortBy, $this->sortAsc ? 'asc' : 'desc');

        //$query = $items->toSql();
        $items = $items->paginate(10);

        return view('livewire.items', [
            'items' => $items,
            //'query' => $query
        ]);
    }

    public function updatingActive()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function mount()
    {
        $this->confirmingItemDeletion = false;
        $this->itemDeleted = false;

        $this->confirmingItemAddition = false;
        $this->itemAdd = false;
    }

    public function deletingItem()
    {
        $this->confirmingItemDeletion = true;
    }

    public function confirmItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }

    public function deleteItem(Item $item)
    {
        $item->delete();
        $this->itemDeleted = true;
        $this->confirmingItemDeletion = false;
    }


    public function AddingItem()
    {
        $this->reset(['item']);
        $this->confirmingItemAddition = true;
    }

    public function confirmItemAddition()
    {
        $this->confirmingItemAddition = true;
    }

    public function saveItem()
    {
        $this->validate();
        //Auth::id();
        // Item::create([
        //     'user_id' => Auth::id(),
        //     'name' => $this->name,
        //     'price' => $this->price,
        //     'status' => $this->price ?? 0,

        // ]);
        Auth::user()->items()->create([
            'name' => $this->name,
            'price' => $this->price,
            'status' => $this->status ?? 0,
        ]);
        $this->confirmingItemAddition = false;
    }
}
