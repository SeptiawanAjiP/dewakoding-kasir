<div class="mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <a href="{{url('product/create')}}" class="btn btn-primary">+ Tambah Produk</a>
                        </div>
                        <div class="col-md-4 mt-3">
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="bi bi-search"></i></span>
                                <input wire:model.live.debounce.300ms='search' type="text" class="form-control" placeholder="Search"
                                    aria-label="Search" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Harga Modal</th>
                                    <th scope="col">Harga Jual</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $item)
                                <tr>
                                    <td>
                                        <img src="{{$item->image_url}}" style="width: 80px;height: 80px" />
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->stock}}</td>
                                    <td>{{$item->cost_price}}</td>
                                    <td>{{$item->selling_price}}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <a href="{{url('product/edit', ['id' => $item->id])}}" class="btn btn-warning">Edit</a>
                                        <button wire:click="destroy('{{ $item->id }}')" class="btn btn-danger" onclick="return confirm('Yakin menghapus produk ini ?')">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Data rows here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <label class="form-label">Per Page</label>
                            <select 
                                wire:model.live='perPage' 
                                class="form-select">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-md-11">
                            {{$products->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                    <!-- Pagination here -->
                </div>
            </div>
        </div>
    </div>
</div>
