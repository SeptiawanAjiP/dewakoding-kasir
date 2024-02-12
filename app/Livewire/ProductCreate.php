<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $cost_price;
    public $selling_price;
    public $stock;
    public $image;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'stock' => 'required',
            'cost_price' => 'required',
            'selling_price' => 'required',
            'image' => 'required|max:2048'
        ]);

        $this->image->storeAs('public/product', $this->image->hashName());

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'cost_price' => $this->cost_price,
            'selling_price' => $this->selling_price,
            'image' => $this->image->hashName(),
            'stock' => $this->stock
        ]);

       
        session()->flash('message', 'Data Berhasil Disimpan.');

        return redirect()->route('product');

    }
    public function render()
    {
        return view('livewire.product-create');
    }
}
