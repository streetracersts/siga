<?php

namespace App\Http\Controllers;

use App\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        {return response()->json(
            Pessoa::all());
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
        $tipo_pessoa = $request['id_tipo_pessoa'];
        switch ($tipo_pessoa){
            case 1:
                $this->validate($request, [
                    'id_tipo_pessoa' => 'required|max:2',
                    'apelido' => 'required|max:255',
                    'telefone1' => 'required',
                ]);
            break;
            case 2:
                $this->validate($request, [
                    'id_tipo_pessoa' => 'required|max:2',
                    'apelido' => 'required|max:255',
                    'telefone1' => 'required'
                ]);
            break;
            case 3:
                $this->validate($request, [
                    'id_tipo_pessoa' => 'required|max:2',
                    'apelido' => 'required|max:255',
                    'telefone1' => 'required'
                ]);
            break;
            default:
                return response()->json([
                    'message' => 'O registro nao pode ser salvo.'
                ],500);
            break;
        }
        $pessoa = Pessoa::create($request->all());
        return response()->json($pessoa, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $pessoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $pessoa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pessoa $pessoa)
    {
        $tipo_pessoa = request('tipo_pessoa');
        switch ($tipo_pessoa){
            case 0:
                $this->validate($request, [
                    'id_tipo_pessoa' => 'required|max:1',
                    'apelido' => 'required|max:255',
                    'cep' => 'required',
                    'telefone1' => 'required:11',
                ]);
                $pessoa->update($request->all());
                return response()->json("Registro atualizado com sucesso.", 200);
                // $pessoa->id = request('id');
                // $pessoa->id_tipo_pessoa = request('id_tipo_pessoa');
                // $pessoa->apelido = request('apelido');
                // $pessoa->nome_razao = request('nome_razao');
                // $pessoa->cnpj = request('cnpj');
                // $pessoa->im = request('im');
                // $pessoa->ie = request('ie');
                // $pessoa->cep = request('cep');
                // $pessoa->endereco = request('endereco');
                // $pessoa->numero = request('numero');
                // $pessoa->complemento = request('complemento');
                // $pessoa->bairro = request('bairro');
                // $pessoa->cidade = request('cidade');
                // $pessoa->uf = request('uf');
                // $pessoa->pais = request('pais');
                // $pessoa->telefone_fixo = request('telefone_fixo');
                // $pessoa->email = request('email');
                // $pessoa->obs = request('obs');
                // //'user_id'     => Auth::user()->id
            break;
            case 1:
                $this->validate($request, [
                    'id_tipo_pessoa' => 'required|max:1',
                    'nome' => 'required|max:255',
                    'cpf' => 'required|max:14',
                    'rg' => 'required|max:50',
                    'o_emissor'=> 'required|max:5',
                    'cep' => 'required|max:8',
                    'endereco'=> 'required|max:255',
                    'numero'=> 'required|max:10',
                    'complemento' => 'required|max:15',
                    'bairro' => 'required|max:100',
                    'cidade' => 'required:100',
                    'uf' => 'required:2',
                    'pais' => 'required:100',
                    'celular' => 'required:10'
                ]);
                $pessoa = Pessoa::create($request->all());
                return response()->json("Registro atualizado com sucesso.", 200);
                // $pessoa->id_tipo_pessoa = request('id_tipo_pessoa');
                // $pessoa->nome = request('nome');
                // $pessoa->cpf = request('cpf');
                // $pessoa->rg = request('rg');
                // $pessoa->o_emissor = request('o_emissor');
                // $pessoa->cep = request('ie');
                // $pessoa->endereco = request('cep');
                // $pessoa->numero = request('numero');
                // $pessoa->complemento = request('complemento');
                // $pessoa->bairro = request('bairro');
                // $pessoa->cidade = request('cidade');
                // $pessoa->uf = request('uf');
                // $pessoa->pais = request('pais');
                // $pessoa->telefone_fixo = request('telefone_fixo');
                // $pessoa->celular = request('celular');
                // $pessoa->email = request('email');
                // $pessoa->obs = request('obs');
                //'user_id'     => Auth::user()->id
            break;
            case 2:
                $this->validate($request, [
                    'id_tipo_pessoa' => 'required|max:1',
                    'nome' => 'required|max:255',
                    'cpf' => 'required|max:14',
                    'rg' => 'required|max:50',
                    'o_emissor'=> 'required|max:5',
                    'cep' => 'required|max:8',
                    'endereco'=> 'required|max:255',
                    'numero'=> 'required|max:10',
                    'complemento' => 'required|max:15',
                    'bairro' => 'required|max:100',
                    'cidade' => 'required:100',
                    'uf' => 'required:2',
                    'pais' => 'required:100',
                ]);
                $pessoa = Pessoa::create($request->all());
                return response()->json("Registro atualizado com sucesso.", 200);
                // $pessoa->id_tipo_pessoa = request('id_tipo_pessoa');
                // $pessoa->nome = request('nome');
                // $pessoa->cpf = request('cpf');
                // $pessoa->rg = request('rg');
                // $pessoa->o_emissor = request('o_emissor');
                // $pessoa->cnh = request('cnh');
                // $pessoa->cnh_categoria = request('cnh_categoria');
                // $pessoa->n_ctps = request('n_ctps');
                // $pessoa->pis = request('pis');
                // $pessoa->cep = request('ie');
                // $pessoa->endereco = request('cep');
                // $pessoa->numero = request('numero');
                // $pessoa->complemento = request('complemento');
                // $pessoa->bairro = request('bairro');
                // $pessoa->cidade = request('cidade');
                // $pessoa->uf = request('uf');
                // $pessoa->pais = request('pais');
                // $pessoa->telefone_fixo = request('telefone_fixo');
                // $pessoa->celular = request('celular');
                // $pessoa->email = request('email');
                // $pessoa->obs = request('obs');
                //'user_id'     => Auth::user()->id
            break;
            default:
                return response()->json([
                    'message' => 'O registro nao pode ser salvo'
                ],200);
            break;
        }
        // $pessoa->save();
        // return response()->json([
        //     'message' => 'Registro atualizado com sucesso!'
        // ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();
        return response()->json([
            'message' => 'Registro apagado com sucesso.'
        ], 200);
    }
}
