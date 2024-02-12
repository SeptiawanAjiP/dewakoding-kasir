<div class="row mt-4 mb-4">
    <div class="col-lg-8 mt-2">
        <div class="row">
            <div class="col-lg-4">
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input 
                        wire:model.live.debounce.300ms='search'
                        type="text" class="form-control" id="autoSizingInputGroup" placeholder="Search">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            @foreach($products as $item)
            <div wire:click="addToCart('{{$item->id}}')" class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-3">
                <div class="card h-100">
                    <img src="{{Str::startsWith($item->image, ['http://', 'https://']) ? $item->image :  asset('/storage/product/'.$item->image)}}" class="card-img-top" alt="..." style="height: 120px;">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text">Rp. {{$item->selling_price}}</p>
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>
        <div class="row mt-4">
            {{$products->links('pagination::bootstrap-5')}}
        </div>
    </div>
    <div class="col-lg-4 mt-2">
       
        <div class="card h-100">
           
                <div class="card-header text-center">
                    @if($order)
                        Invoice ID : {{ $order->invoice_number }}
                    @else
                        Aplikasi Kasir
                    @endif
                </div>
                
               
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    @if($order)
                        @foreach($order->orderProducts as $item)
                        <div class="card mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                
                                <img src="{{Str::startsWith($item->product->image, ['http://', 'https://']) ? $item->product->image :  asset('/storage/product/'.$item->product->image)}}" style="width: 80px;height: 80px" />
                            
                                <div>
                                    <span>{{$item->product->name}}</span><br>
                                    <span class="text-muted">Rp. {{$item->product->selling_price}}</span>
                                </div>
                                <div class="d-flex align-items-center me-2">
                                    <button class="btn btn-sm btn-warning me-2">-</button>
                                    <span>{{$item->quantity}}</span>
                                    <button class="btn btn-sm btn-primary ms-2">+</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center">
                            <p>Keranjang masih kosong</p>
                            <button wire:click="createOrder()" class="btn btn-primary btn-block">Buka Kasir</button>
                        </div>
                    @endif
                    
                </div>
                
            
        </div>
        
        
    </div>
</div>
