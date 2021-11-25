<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoas;
use DB;

class pessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Pessoas $pessoas) {
        $this->pessoas = $pessoas;
  }
    public function index()
    {
       $pessoas = Pessoas::all();
      return response()->json([$pessoas],200);
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
        $pessoa = $this->pessoas->create([
            'nome' => $request->nome,
            'idade' => $request->idade,
            'sexo' => $request->sexo
       
           ]);
            return response()->json(['dados'=>$pessoa,'msg'=> 'Registro criado com sucesso'], 200);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pessoa = Pessoas::find($id);
        return response()->json([$pessoa],200);
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
        
         $pessoa = Pessoas::find($id);
         $pessoa->nome = $request->nome;
         $pessoa->save();
         return response()->json(['dados'=>$pessoa, 'msg'=> 'Registro alterado com sucesso'], 200);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pessoa = Pessoas::find($id);
        $pessoa->delete();
        return response()->json(['msg'=> 'Registro deletado com sucesso'], 200); 
    }
}
