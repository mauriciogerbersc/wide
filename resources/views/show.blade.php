@extends('layout.app')

@section('body')
<div class="row">
    <a href="/" class="btn btn-primary"><< Voltar</a>
</div>
<div class="container">
<div class="row">
{{$dados['captura']}}
</div>   
</div>
@endsection

