@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session()->get('sucess'))
            <div class="alert alert-success"> {{session()->get('sucess')}}</div>
        @endif
            @if(session()->get('error'))
            <div class="alert alert-warning"> {{session()->get('error')}}</div>
        @endif


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="d-flex justify-content-between align-items-center">
                        <form action="{{route('store')}}" method="post">
                            @csrf
                            <div class="col-md-12 d-flex mt-2 mb-2">
                                <input type="text" class="form-control" placeholder="Buscar" name="termo">
                                <button class="btn btn-primary ml-2">Buscar</button>
                            </div>
                        </form>

                        <div class="paginete  mt-2 mb-2 mr-2 ">
                            {{$carros->render("pagination::bootstrap-4")}}
                        </div>
                    </div>


                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Combustivel</th>
                            <th scope="col">Portas</th>
                            <th scope="col">Km</th>
                            <th scope="col">Cambio</th>
                            <th scope="col">Cor</th>
                            <th colspan=2 class="text-center">action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($carros as $carro)
                            <tr>
                                <th scope="row">{{$carro->id}}</th>
                                <th>{{$carro->nome}}</th>
                                <th>{{$carro->ano}}</th>
                                <th>{{$carro->combustivel}}</th>
                                <th>{{$carro->portas}}</th>
                                <th>{{$carro->quilometragem}}</th>
                                <th>{{$carro->cambio}}</th>
                                <th>{{$carro->cor}}</th>
                                <th><a href="{{$carro->url}}">Acessar</a>
                                <th><a href="{{route('delete',$carro->id)}}" class="text-danger">
                                    Delete</a></th>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
