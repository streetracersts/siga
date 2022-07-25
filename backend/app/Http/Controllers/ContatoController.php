<?php

namespace App\Http\Controllers;

use App\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = Contato::All();
        return response()->json([
            'contatos' => $contatos,
        ], 200);
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
        $this->validate($request, [
            'id_pessoa' => 'required',
            'nome' => 'required|max:255',
            'contato_direto' => 'required|max:11'
        ]);
        $contato = Contato::create($request->all());
        return response()->json([
            'contato' => $contato,
            'message' => 'Contato cadastrado'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function show(Contato $contato)
    {
        $contato = Contato::findOrFail($contato);
        return response()->json([
            'contato' => $contato,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contato $contato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contato $contato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contato $contato)
    {
        $contato->delete();
        return response()->json([
            'message' => 'Contato removida.'
        ], 200);
    }
}
