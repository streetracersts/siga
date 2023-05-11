<?php

namespace App\Http\Controllers;
use App\OsHasPessoas;
use Illuminate\Http\Request;

class OsHasPessoasController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_os' => 'required|max:255',
            'id_pessoa' => 'required|max:255'
        ]);
        $OsHasPessoas = OsHasPessoas::create($request->all());
        return response()->json($OsHasPessoas, 200);
    }
}
