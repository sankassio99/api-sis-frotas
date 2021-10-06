<?php

namespace App\Http\Controllers;
use App\Models\Condutor;
use App\Models\Orden;
use Illuminate\Http\Request;
// use Laravel\Lumen\Routing\Controller as BaseController;

class OrdemController extends Controller
{
    public function index(Request $request){
        $ordens = Orden::with('veiculo','condutor')->paginate($request->per_page);
        return $ordens;
    }

    public function store(Request $request){
        return response()->json(Orden::create(
            ['origem' => $request->origem, 
            'destino' => $request->destino, 
            'data' => $request->data,
            'hora' => $request->hora,
            'distancia' => $request->distancia,
            'veiculo_id' => $request->veiculo_id,
            'condutor_id' => $request->condutor_id], 201));
    }

    public function show(int $id){
        $condutor = Orden::find($id);
        if($condutor==null){
            return response()->json($condutor, 204) ;
        }
        return response()->json($condutor) ;
        
    }

    public function update(int $id, Request $request){
        $condutor = Orden::find($id);
        if($condutor==null){
            return response()->json(["erro" => "Recurso não encontrado"], 404) ;
        }
        $condutor->fill($request->all());
        $condutor->save();
        return response()->json($condutor) ;
        
    }

    public function destroy(int $id){
        $qtdRecursosRemovidos = Orden::destroy($id);

        if($qtdRecursosRemovidos === 0){
            return response()->json(["erro"=> "Recurso não encontrado"], 204);
        }

        return response()->json("removido com sucesso");
        // return response()->json(Serie::create($request->all(), 201));
    }

    public function showByVeiculo(string $veiculo){
        $ordem = Orden::join('veiculos','ordens.veiculo_id', '=', 'veiculos.id')
        ->where('modelo', $veiculo)->with('veiculo','condutor')->get();
        if($ordem==null){
            return response()->json($ordem, 204) ;
        }
        return response()->json($ordem) ;
        
    }

    public function showByCondutor(string $condutor){
        $ordem = Orden::join('condutors','ordens.condutor_id', '=', 'condutors.id')
        ->where('nome', $condutor)->with('veiculo','condutor')->get();
        if($ordem==null){
            return response()->json($ordem, 204) ;
        }
        return response()->json($ordem) ;
        
    }

    public function showByData(string $data){
        $ordem = Orden::where('data', $data)->with('veiculo','condutor')->get();
        if($ordem==null){
            return response()->json($ordem, 204) ;
        }
        return response()->json($ordem) ;
        
    }

    public function showByOrigem(string $origem){
        $ordem = Orden::where('origem', $origem)->with('veiculo','condutor')->get();
        if($ordem==null){
            return response()->json($ordem, 204) ;
        }
        return response()->json($ordem) ;
        
    }

    public function showByDestino(string $destino){
        $ordem = Orden::where('destino', $destino)->with('veiculo','condutor')->get();
        if($ordem==null){
            return response()->json($ordem, 204) ;
        }
        return response()->json($ordem) ;
        
    }
}