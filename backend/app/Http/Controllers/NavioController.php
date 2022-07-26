<?php

namespace App\Http\Controllers;

use App\Navio;
use Illuminate\Http\Request;

class NavioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {return response()->json(
            Navio::all());
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
            'nome' => 'required|max:255',
            'bandeira' => 'required|max:50'
        ]);
        $navio = Navio::create($request->all());
        return response()->json($navio, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Navio  $navio
     * @return \Illuminate\Http\Response
     */
    public function show(Navio $navio)
    {
        $navio = Navio::findOrFail($navio);
        return response()->json([
            'navio' => $navio,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Navio  $navio
     * @return \Illuminate\Http\Response
     */
    public function edit(Navio $navio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Navio  $navio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Navio $navio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Navio  $navio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Navio $navio)
    {
        $navio->delete();
        return response()->json([
            'message' => 'Embarcação removida.'
        ], 200);
    }
}
