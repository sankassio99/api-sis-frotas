<?php

namespace App\Http\Controllers;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    public function index(){
        $veiculos = Veiculo::all();
        return $veiculos;
    }

    public function store(Request $request){
        return response()->json(Veiculo::create(
            ['modelo' => $request->modelo, 
            'marca' => $request->marca, 
            'quilometragem' => $request->quilometragem,
            'estadoConservacao' => $request->estadoConservacao,
            'placa' => $request->placa], 201));
    }

    public function show(int $id){
        $veiculo = Veiculo::find($id);
        if($veiculo==null){
            return response()->json($veiculo, 204) ;
        }
        return response()->json($veiculo) ;
        
    }

    public function update(int $id, Request $request){
        $veiculo = Veiculo::find($id);
        if($veiculo==null){
            return response()->json(["erro" => "Recurso não encontrado"], 404) ;
        }
        $veiculo->fill($request->all());
        $veiculo->save();
        return response()->json($veiculo) ;
        
    }

    public function destroy(int $id){
        $qtdRecursosRemovidos = Veiculo::destroy($id);

        if($qtdRecursosRemovidos === 0){
            return response()->json(["erro"=> "Recurso não encontrado"], 204);
        }

        return response()->json("removido com sucesso");
        // return response()->json(Serie::create($request->all(), 201));
    }

    public function getByMarca(string $marca){
        $veiculo = Veiculo::where('marca', $marca)->get();

        if($veiculo==null){
            return response()->json($veiculo, 204) ;
        }
        return response()->json($veiculo) ;
    }

    public function getByModelo(string $modelo){
        $veiculo = Veiculo::where('modelo', $modelo)->get();

        if($veiculo==null){
            return response()->json($veiculo, 204) ;
        }
        return response()->json($veiculo) ;
    }
    public function getByIntervaloQuilometragem(Request $request){
        $inicio = $request->inicio ;
        $fim = $request->fim;
        $veiculo = Veiculo::where('quilometragem','>', $inicio)
        ->where('quilometragem','<', $fim)
        ->get();

        if($veiculo==null){
            return response()->json($veiculo, 204) ;
        }
        return response()->json($veiculo) ;
    }

    public function getByEstado(string $estado){
        $veiculo = Veiculo::where('estadoConservacao', $estado)->get();
        if($veiculo == null){
            return response()->json($veiculo, 201);
        }
        return response()->json($veiculo);
    }

}

?>