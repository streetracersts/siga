<?php

namespace App\Http\Controllers;

use App\TipoServico;
use Illuminate\Http\Request;

class TipoServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(TipoServico::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
       
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
        $tiposervico = TipoServico::create($request->all());
        return response()->json($tiposervico, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoServico  $tipoServico
     * @return \Illuminate\Http\Response
     */
    public function show(TipoServico $tiposervico)
    {
        $tiposervico = TipoServico::findOrFail($tiposervico);
        return response()->json([
            'tiposervico' => $tiposervico,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoServico  $tipoServico
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoServico $tipoServico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoServico  $tipoServico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $tiposervico = TipoServico::findOrFail($id);
        $tiposervico->update($request->all());
        //return $company;
        return response()->json([
            'message' => 'Registro atualizado com sucesso!'
        ], 200);

        // $tipoServico=TipoServico::where('id',$id)->first();
        // $tipoServico->tipo=$request->get('tipo');
        // $tipoServico->descricao=$request->get('descricao');
        // $todo->is_completed=$request->get('is_completed');
        // $todo->save();
        // return response()->json([
        //     'message' => 'Registro atualizado com sucesso!'
        // ], 200);

        //return redirect()->route('tiposervico.index')->with('success', 'Updated Todo');
        // $tipoServico->save();
        // return response()->json([
        //     'message' => 'Registro atualizado com sucesso!'
        // ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoServico $tipoServico
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoServico $tiposervico)
    {      
        $tiposervico->delete();
        return response()->json([
            'message' => 'Tipo de serviço removido.'
        ], 200);
    }
}
