@extends('layout.app')

@section('body')
<div class="row">
    <h2>Urls cadastradas</h2>
</div>
<div class="row">
  
    @if(count($urls) > 0)
    <table class="table table-ordered table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">URL</th>
                <th scope="col">HTTP</th>
                <th scope="col">Data</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($urls as $url)
            <tr>
                <td>{{$url->id}}</td>
                <td>{{$url->urlNome}}</td>
                <td>{{$url->url}}</td>
                <td>{{$url->created_at}}</td>
                <td>
                    <a href="/url/visualizar/{{$url->id}}" class="btn btn-sm btn-warning">Visualizar</a>
                    <a href="/url/editar/{{$url->id}}" class="btn btn-sm btn-primary">Editar</a>
                    <a href="/url/deletar/{{$url->id}}" class="btn btn-sm btn-danger">Apagar</a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>  

<div class="row">
    <a href="/url/cadastro" class="btn btn-primary">Cadastre URLs</a>
</div>

@endsection