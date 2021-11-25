<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livros;
use DB;

class livrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Livros $livros) {
        $this->livros = $livros;
  }

    public function index(Request $request)
    {
       
       //essa requisição tera que ser do tipo POST e 
        //na tela de pesquisa tera que ser enviado do front o campo method do tipo GET

        if($request->has('psq'))
        {
           $psq = $request->psq;
            $livros = DB::select("select * from livros where nome like '%$psq%'");
          // $livros = Livros::where('nome','LIKE',"%$psq%")->get();

        }else{
            $livros = Livros::all();
           
        }
       
       
       return response()->json([$livros],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $livro = $this->livros->create([
         'nome' => $request->nome,
         'categoria' => $request->categoria,
         'codigo' => $request->codigo,
         'autor' => $request->autor,
         'ebook' => $request->ebook,
         'tamanhoArquivo' => $request->tamanhoArquivo,
         'peso'=> $request->peso,
         'pessoa' => $request->pessoa
        ]);
         return response()->json(['dados'=>$livro,'msg'=> 'Registro criado com sucesso'], 200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livro = Livros::find($id);
        return response()->json([$livro],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //o tipo da requisição é do tipo POST e deve ser enviado o campo method do tipo PUT
        
        $livro = Livros::find($id);
        $livro->nome = $request->nome;
        $livro->categoria = $request->categoria;
        $livro->codigo = $request->codigo;
        $livro->autor = $request->autor;
        $livro->ebook = $request->ebook;
        $livro->tamanhoArquivo = $request->tamanhoArquivo;
        $livro->peso = $request->peso;
        $livro->pessoa = $request->pessoa;
        $livro->save();
        return response()->json(['dados'=>$livro, 'msg'=> 'Registro alterado com sucesso'], 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livro = Livros::find($id);
        $livro->delete();
        return response()->json(['msg'=> 'Registro deletado com sucesso'], 200); 
    }
}
