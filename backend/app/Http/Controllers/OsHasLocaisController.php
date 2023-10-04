<?php

namespace App\Http\Controllers;
use App\OsHasLocais;
use Illuminate\Http\Request;

class OsHasLocaisController extends Controller
{ 
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_os' => 'required|max:255',
            'id_local' => 'required|max:255'
        ]);
        $OsHasLocais = OsHasLocais::create($request->all());
        return response()->json($OsHasLocais, 200);
    }
}
