<?php

namespace App\Http\Controllers;

use App\TipoPessoa;
use Illuminate\Http\Request;

class TipoPessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TipoPessoa::all());
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
            'tipo' => 'required|max:255',
        ]);
        $tipopessoa = TipoPessoa::create($request->all());
        return response()->json($tipopessoa, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoPessoa  $TipoPessoa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoPessoa  $TipoPessoa
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPessoa $tipopessoa)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoPessoa  $TipoPessoa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoPessoa $tipopessoa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoPessoa  $TipoPessoa
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPessoa $tipopessoa)
    {
        $tipopessoa->delete();
        return response()->json([
            'message' => 'Tipo de pessoa removido.'
        ], 200);
    }
}
