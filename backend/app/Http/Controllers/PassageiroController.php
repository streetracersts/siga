<?php

namespace App\Http\Controllers;

use App\Passageiro;
use Illuminate\Http\Request;

class PassageiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('passageiros');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Passageiro  $passageiro
     * @return \Illuminate\Http\Response
     */
    public function show(Passageiro $passageiro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Passageiro  $passageiro
     * @return \Illuminate\Http\Response
     */
    public function edit(Passageiro $passageiro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Passageiro  $passageiro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Passageiro $passageiro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Passageiro  $passageiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Passageiro $passageiro)
    {
        //
    }
}
