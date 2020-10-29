@extends('layouts.front')

@section('content')
    <div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <div class="row front">
            @foreach($products as $key => $product)
                <div class="col-md-4">
                    <div class="card" style="height: 510px">
                        @if($product->photos->count())
                            <img src="{{asset('storage/' . $product->photos->first()->image)}}" alt="{{$product->name}}" class="card-img-top" style="height: 200px;">
                        @else
                            <img src="{{asset('assets/img/no-photo.jpg')}}" alt="Sem Foto" class="card-img-top" style="height: 200px;">
                        @endif
                        <div class="card-body" style="height: 308px; display: flex; flex-direction: column; justify-content: space-between;">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">
                                {{$product->description}}
                            </p>
                            <h5>R$ {{number_format($product->price, '2', ',', '.')}}</h5>
                            <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">
                                Ver Produto
                            </a>
                        </div>
                    </div>
                </div>
                @if(($key + 1) % 3 == 0) </div><div class="row front"> @endif
            @endforeach
        </div>

        <div class="row">
            <div class="col-12" style="text-align: center;">
                <h5>Loja em destaque</h5>
                <hr>
            </div>
            @foreach($stores as $store)
                <div class="col-12" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    @if($store->logo)
                        <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da {{$store->name}}" class="img-fluid" style="width:60px; height:60px; border-radius: 50%;">
                    @else
                        <img src="http://via.placeholder.com/60x60.png?text=logo" alt="Sem imagem" class="img-fluid" style="width:60px; height:60px; border-radius: 50%;">
                    @endif
                    <h6 style="margin-top:10px;">{{$store->name}}</h6>
                    <p style="font-size: 0.8rem;">{{$store->description}}</p>

                    <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">Ver Loja</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
