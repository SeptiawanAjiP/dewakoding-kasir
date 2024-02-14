<div class="row mt-4 mb-4">
    <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4">
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input wire:model.live.debounce.300ms='search' type="text" class="form-control"
                            id="autoSizingInputGroup" placeholder="Search">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if(count($products) > 0)
                @foreach ($products as $item)
                    <div wire:click="updateCart('{{ $item->id }}')" class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-3">
                        <div class="card h-100">
                            <img src="{{ Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset('/storage/product/' . $item->image) }}"
                                class="card-img-top" alt="..." style="height: 120px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->name }}</h5>
                                <p class="card-text">{{ $item->selling_price_formatted }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 mt-4">
                    <div class="alert alert-danger" role="alert">
                        Produk masih kosong, input produk terlebih dahulu.
                    </div>
                </div>
            @endif

        </div>
        <div class="row mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <div class="col-lg-4 mt-2">

        <div class="card h-100">

            <div class="card-header text-center">
                @if ($order)
                    Order Code : {{ $order->invoice_number }}
                @else
                    Aplikasi Kasir
                @endif
            </div>


            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-success text-center">
                        {{ session('message') }}
                    </div>
                @endif

                @if ($order)
                    @foreach ($order->orderProducts as $item)
                        <div class="card mt-2">
                            <div class="d-flex justify-content-between align-items-center">

                                <img src="{{ Str::startsWith($item->product->image, ['http://', 'https://']) ? $item->product->image : asset('/storage/product/' . $item->product->image) }}"
                                    style="width: 80px;height: 80px" />

                                <div>
                                    <span>{{ $item->product->name }}</span><br>
                                    <span class="text-muted">{{ $item->product->selling_price_formatted }}</span>
                                </div>
                                <div class="d-flex align-items-center me-2">
                                    <button class="btn btn-sm btn-warning me-2"
                                        wire:click="updateCart('{{ $item->product->id }}', false)">-</button>
                                    <span>{{ $item->quantity }}</span>
                                    <button class="btn btn-sm btn-primary ms-2"
                                        wire:click="updateCart('{{ $item->product->id }}')">+</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @if(count($products) > 0)
                        <div class="text-center">
                            <p>Keranjang masih kosong</p>
                            <button wire:click="createOrder()" class="btn btn-primary btn-block">Mulai Transaksi</button>
                        </div>
                    @endif
                @endif

                @if ($total_price != 0)
                    <h4 class="text-center mt-3">Total : Rp {{  number_format($total_price, 0, ',', '.') }}</h4>
                @endif
            </div>
            @if($order)
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Pembayaran
                    </button>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" wire:submit="done" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label for="paid_amount" class="form-label">Uang yang dibayarkan</label>
                        <input type="number" class="form-control" id="paid_amount" name="paid_amount" wire:model="paid_amount">
                        @error('paid_amount')
                          <div class="alert alert-danger mt-2">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
                </form>
            </div>
           
          </div>
        </div>
      </div>

</div>
