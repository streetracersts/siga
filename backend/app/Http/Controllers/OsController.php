<?php

namespace App\Http\Controllers;


use App\Os;
use Illuminate\Http\Request;
use Auth;

class OsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $oss = Os::join('pessoas', 'oss.id_pessoa', '=', 'pessoas.id')
        ->join('navios', 'oss.id_navio', '=','navios.id')
        ->join('tipo_servico', 'oss.id_tipo_servico', 'tipo_servico.id')
        ->get(['oss.*', 'pessoas.apelido', 'navios.nome','tipo_servico.tipo']);
        {return response()->json(
           $oss);
        }
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
            'id_navio' => 'required',
            'id_tipo_servico' => 'required',
            'descricao_servico' => 'required|max:255',
            'status_os' => 'required'
        ]);

        $os = Os::create($request->all());
        return response()->json([
            'os' => $os,
            'message' => 'Ordem de Serviço criada com sucesso.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\os  $os
     * @return \Illuminate\Http\Response
     */
    public function show(os $os)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\os  $os
     * @return \Illuminate\Http\Response
     */
    public function edit(os $os)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\os  $os
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, os $os)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\os  $os
     * @return \Illuminate\Http\Response
     */
    public function destroy(os $os)
    {
        //
    }
}
