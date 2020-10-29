@extends('layouts.front')

@section('content')
    <div class="row front">
        <div class="col-12">
            <h2>{{$category->name}}</h2>
            <hr>
        </div>
        @forelse($category->products as $key => $product)
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
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Nenhum produto encontrado para esta categoria.</h3>
            </div>
        @endforelse
    </div>
@endsection
