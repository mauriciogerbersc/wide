@extends('layout.app')

@section('body')
<div class="row">
<h2>Edição de URL</h2>
</div>
<div class="card border">
    <div class="card-body">
        <form action="/url/update/{{$url->id}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="urlNome">Nome</label>
                <input 
                type="text" 
                value="{{$url->urlNome}}"
                class="form-control {{$errors->has('urlNome') ? 'is-invalid' : '' }}" 
                name="urlNome" 
                placeholder="Informe o nome da url" />
                @if($errors->has('urlNome'))
                    <div class="invalid-feedback">
                        {{$errors->first('urlNome')}}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input 
                type="text"
                value="{{$url->url}}"
                 class="form-control {{$errors->has('url') ? 'is-invalid' : ''}}" 
                 name="url" 
                 id="url" 
                 placeholder="Informe a URL" />

                 @if($errors->has('url'))
                 <div class="invalid-feedback">
                        {{$errors->first('url')}}
                 </div>
                 @endif
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    
</div>
<br>
<div class="row">
    <a href="/" class="btn btn-primary"><< Voltar</a>
</div>
@endsection