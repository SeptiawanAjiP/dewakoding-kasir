<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class OrderList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function render()
    {
        return view('livewire.order-list', [
            'orders' => Order::search($this->search)
                        ->whereNotNull('done_at')
                        ->orderBy('done_at', 'DESC')
                        ->paginate($this->perPage)
        ]);
    }
}
