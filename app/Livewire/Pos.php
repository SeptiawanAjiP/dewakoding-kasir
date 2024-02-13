<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;

class Pos extends Component
{
    public $search = '';
    public $product;
    public $order;
    public $total_price;

    public function render()
    {
        $this->order = Order::where('done_at', null)
                ->with('orderProducts')
                ->latest()
                ->first();
        $this->total_price = $this->order->total_price ?? 0;
        return view('livewire.pos', [
            'products' => Product::search($this->search)->paginate(12),
            'order' => $this->order
        ]);
    }

    public function createOrder()
    {
        $this->order = Order::where('done_at', null)
                ->latest()
                ->first();

        if ($this->order ==  null) {
            $this->order = Order::create([
                'invoice_number' => $this->generateUniqueCode()
            ]);
        }
        session()->flash('message', 'Sukses mulai transaksi, silakan pilih produk.');
    }

    public function addToCart($productId)
    {
        try {
            if ($this->order) {
                $product = Product::findOrFail($productId);
                $orderProduct = OrderProduct::where('order_id', $this->order->id)
                    ->where('product_id', $productId)
                    ->first();
                
                if ($orderProduct) {
                    $orderProduct->increment('quantity', 1);
                    $orderProduct->save();
                } else {
                    OrderProduct::create([
                        'order_id' => $this->order->id,
                        'product_id' => $product->id,
                        'unit_price' => $product->selling_price,
                        'quantity' => 1
                    ]);
                }
                $this->total_price = $this->order->total_price ?? 0;
    
                session()->flash('message', 'Produk berhasil ditambahkan');
            } else {
                session()->flash('message', 'Klik Mulai Transaksi Dahulu');
            }
            
        } catch (ValidationException $e) {
            dd($e);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    function generateUniqueCode($length = 6) {
        $randomNumber = mt_rand(1, pow(10, $length) - 1);
        $randomNumber = str_pad($randomNumber, $length, '0', STR_PAD_LEFT);
        return $randomNumber;
    }

}
