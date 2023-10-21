<?php

namespace App\Http\Controllers;
use App\OsHasLocais;
use Illuminate\Http\Request;

class OsHasLocaisController extends Controller
{ 
    public function show(Request $request, $id)
    {
        $locaisos = OsHasLocais::Join('locais', 'os_has_locais.id_local', '=', 'locais.id')
        ->where('os_has_locais.id_os', "=", $id)
        ->get(['locais.nome_local']);
        
    
        {return response()->json(
           $locaisos);
        }
        // $locais = OsHasLocais::All();
        // return response()->json([
        //     'locais' => $locais,
        // ], 200);
    }
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
