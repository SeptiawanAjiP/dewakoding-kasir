<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function destroy($id)
    {
        Product::destroy($id);
        session()->flash('message', 'Data Berhasil Dihapus.');
        return redirect()->route('product');
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => Product::search($this->search)
                        ->paginate($this->perPage)
        ]);
    }
}
