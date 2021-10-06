<?php

namespace App\Http\Controllers;
use App\Models\Condutor;
use App\Models\Cnh;
use Illuminate\Http\Request;
// use Laravel\Lumen\Routing\Controller as BaseController;

class CondutorController extends Controller
{
    //
    public function index(){
        $condutores = Condutor::with('cnh')->get();
        return $condutores;
    }

    public function store(Request $request){
        $resultSave = Condutor::create(['nome' => $request->nome], 201);
        if($resultSave=="201"){
            return response()->json($resultSave);
        }
        return response()->json(Cnh::create([
            'numero' => $request->numero,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'dataNacimento' => $request->dataNacimento,
            'categoria' => $request->categoria,
            'condutor_id' => $resultSave->id ], 201)
        );
    }

    public function show(int $id){
        $condutor = Condutor::with('cnh')->find($id);
        if($condutor==null){
            return response()->json($condutor, 204) ;
        }
        return response()->json($condutor) ;
        
    }

    public function update(int $id, Request $request){
        $condutor = Condutor::with('cnh')->find($id);
        if($condutor==null){
            return response()->json(["erro" => "Recurso não encontrado"], 404) ;
        }
        $condutor->fill($request->all());
        $condutor->save();
        return response()->json($condutor) ;
        
    }

    public function destroy(int $id){
        $qtdRecursosRemovidos = Condutor::destroy($id);

        if($qtdRecursosRemovidos === 0){
            return response()->json(["erro"=> "Recurso não encontrado"], 204);
        }

        return response()->json("removido com sucesso");
        // return response()->json(Serie::create($request->all(), 201));
    }

    public function showByCnh(string $numero){
        $condutor = Condutor::join('cnhs','cnhs.condutor_id', '=', 'condutors.id')
        ->where('numero', $numero)->get();
        // ->select('condutors.nome','cnhs.numero','cnhs.cpf')

        if($condutor==null){
            return response()->json($condutor, 204) ;
        }
        return response()->json($condutor) ;
        
    }

    public function showByNome(string $nome){
        $condutor = Condutor::join('cnhs','cnhs.condutor_id', '=', 'condutors.id')
        ->where('nome', $nome)->get();
        if($condutor==null){
            return response()->json($condutor, 204) ;
        }
        return response()->json($condutor) ;
        
    }

    public function showByCategoria(string $categoria){
        $condutor = Condutor::join('cnhs','cnhs.condutor_id', '=', 'condutors.id')
        ->where('categoria', $categoria)->get();
        if($condutor==null){
            return response()->json($condutor, 204) ;
        }
        return response()->json($condutor) ;
        
    }

    

}
