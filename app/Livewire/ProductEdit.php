<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class ProductEdit extends Component
{
    use WithFileUploads;
    public $id;
    public $name;
    public $description;
    public $cost_price;
    public $selling_price;
    public $stock;
    public $image;
    public $image_url;

    public function mount($id)
    {
        $product = Product::find($id);
        $this->id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->cost_price = $product->cost_price;
        $this->selling_price = $product->selling_price;
        $this->stock = $product->stock;
        $this->image_url = $product->image_url;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'cost_price' => 'required',
            'selling_price' => 'required'
        ]);

        $product = Product::find($this->id);
       
        if ($this->image) {
            $this->image->storeAs('public/product', $this->image->hashName());

            $product->update([
                'name' => $this->name,
                'stock' => $this->stock,
                'cost_price' => $this->cost_price,
                'selling_price' => $this->selling_price,
                'image' => $this->image->hashName(),
            ]);
        } else {
            $product->update([
                'name' => $this->name,
                'stock' => $this->stock,
                'cost_price' => $this->cost_price,
                'selling_price' => $this->selling_price
            ]);
        }
        session()->flash('message', 'Data Berhasil Diubah.');
        return redirect()->route('product');
    }

    public function render()
    {
        return view('livewire.product-edit');
    }
}
