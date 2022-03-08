@extends('layouts.site')

@section('title', 'Todos os produtos')
@section('content')
    <form action="Procura" method = "GET">
        <select class ='procura'  name="categoria_id" onchange = "this.form.submit()">
            <option value=" "> Selecione uma categoria </option>
            @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
            @endforeach
        </select>
    </form>
    @foreach ($produtos as $produto)
        @isset ($categoria_id)
        @if ($produto->categoria_id == $categoria_id->id)
            <section class = "loja">
                <span>
                    <p>
                        <div class="card">
                            <h2 class = "title"> {{$produto->nome}}</h2>
                            <p class = "descricao">{{$produto->getTitleShortAttribute()}}</p>
                            <div class = "container-categoria-imagem">
                                <spam class ="categoria">{{ $produto->categoria()->pluck('categoria')->first() }}</spam>
                                <img class = "imagem" src="\storage\{{$produto->imagem}}" alt="">
                            </div>
                            <div class="money">
                                @if($produto->quantidade == 0)
                                    <span class = "preco" >Preço: Produto Indisponivel</span>
                                @else
                                    <span class = "quantidade">Quantidade: {{$produto->quantidade}}</span>
                                    <span class = "preco" >Preço:R$ {{$produto->preco}},00</span>
                                @endif
                            </div>
                        </div>
                    </p>
                </span>
            </section>
        @endif
        @endisset
        @empty($categoria_id)
        <section class = "loja">
            <div class = "segundaBox">
                <div class="card">
                    <h2 class = "title"> {{$produto->nome}}</h2>
                    <p class = "descricao">{{$produto->getTitleShortAttribute()}}</p>
                    <div class = "container-categoria-imagem">
                        <spam class ="categoria">{{ $produto->categoria()->pluck('categoria')->first() }}</spam>
                        <img class = "imagem" src="\storage\{{$produto->imagem}}" alt="">
                    </div>
                    <div class="money">
                        @if($produto->quantidade == 0)
                            <span class = "preco" >Preço: Produto Indisponivel</span>
                        @else
                            <span class = "quantidade">Quantidade: {{$produto->quantidade}}</span>
                            <span class = "preco" >Preço:R$ {{$produto->preco}},00</span>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endempty
    @endforeach
@endsection
