@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pets para adoção') }}</div>
                <table class="table table-striped">
                    <tr>
                        <th>Nome</th>
                        <th>Raça</th>
                        <th>Idade</th>
                        <th>Peso</th>
                        <th>Cidade</th>
                        <th>Contato adoção</th>
                    </tr>
                    @forelse($results as $result)
                        <tr>
                            <td>{{$result->name}}</td>
                            <td>{{$result->breed}}</td>
                            <td>{{$result->age}} Anos</td>
                            <td>{{$result->weight}}</td>
                            <td>{{$result->city}}</td>
                            <td>{{$result->email}}</td>
                        </tr>
                    @empty
                        <td colspan="6" align="center"><p>Nenhum pet para adoção na sua cidade</p></td>
                    @endforelse
                </table>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
