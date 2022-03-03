<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    private $produtos;
    private $categorias;

    public function __construct(Produto $produtos, Categoria $categorias)
    {
        $this->produtos = $produtos;
        $this->categorias = $categorias;
    }
    public function index()
    {
        $produtos = $this->produtos->all();
        return view('produto.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = $this->categorias->all();
        return view('produto.crud', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreprodutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdutoRequest $request)
    {
        $produto = new Produto();
        $produto->nome = $request->input("nome");
        $produto->preco = $request->input("preco");
        $produto->descricao = $request->input("descricao");
        $produto->quantidade = $request->input("quantidade");
        $imagem = $request->file('imagem')->store('produtos', 'public');
        $produto->imagem = $imagem;
        $produto->categoria_id = $request->input('categoria_id');

        $produto->save();
        return redirect('produto');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = $this->produtos->find($id);
        $categorias = $this->categorias->find($produto->categoria_id); // Auxilia para mostrar na tela o campo de categoria
        $produto->categoria = $categorias->categoria;
        return json_encode($produto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = $this->produtos->find($id);
        $categorias = $this->categorias->all();
        return view('produto.crud', compact(['produto','categorias']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprodutoRequest  $request
     * @param  \App\Models\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProdutoRequest $request, $id)
    {
        $datas = $request->all();
        $produto = $this->produtos->find($id);
        //Verificação para a imagem
        if($request->hasFile('imagem'))
        {   
            Storage::delete('public/' , $produto->imagem);
            $datas['imagem'] = $request->file('imagem')->store('produtos','public');
        }
        $produto->update($datas);
        return redirect('produto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = $this->produtos->find($id);
        Storage::drive('public')->delete($produto->imagem);
        $produto->delete();
        return redirect(route('produto.index'));
    }
}
