@extends('layouts.app')

@section('content')
    <h1>Edit Loja</h1>
    <form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")

        <div class="form-group">
            <label for="">Nome Loja</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$store->name}}">
            @error('name')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$store->description}}">
            @error('description')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Telefone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$store->phone}}">
            @error('phone')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">
            @error('mobile_phone')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <p>
                <img src="{{asset('storage/' . $store->logo)}}" alt="">
            </p>
            <label>Fotos da Loja</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div>
            <button type="submit" class="btn btn-success btn-lg">Atualizar Loja</button>
        </div>
    </form>
@endsection

@section('scripts')
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script>
        $(document).ready(function(){
            $("#phone").inputmask({"mask": "(99) 9999-9999"}); //specifying options
            $("#mobile_phone").inputmask({"mask": "(99) 99999-9999"}); //specifying options
        });
    </script>
@endsection
