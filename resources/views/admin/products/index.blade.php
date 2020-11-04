@extends('layouts.app')

@section('content')
    @if(auth()->user()->store()->count() == 0)
        <h3 class="alert alert-danger">Não existe loja criada, crie primeiro sua loja e as categorias.</h3>
    @else
        @if($products == null)
            <h3 class="alert alert-danger">Não existem produtos, crie primeiro sua loja e as categorias.</h3>
            <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-success">Criar Produto</a>
        @else
            <a href="{{route('admin.products.create')}}" class="btn btn-sm btn-success">Criar Produto</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Loja</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->store->name}}</td>
                            <td>R$ {{number_format($product->price, 2, ',', '.')}}</td>
                            <td>
                                <div class="btn btn-group">
                                    <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{$products->links()}}
        @endif
    @endif
@endsection
