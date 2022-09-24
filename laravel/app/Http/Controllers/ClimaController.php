<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Clima;
use App\Models\Cidade;

class ClimaController extends Controller
{
    public function index(Clima $climas,Cidade $cidades)
    {
        $rows = $climas->getAll();

        foreach ($rows as $key => $row) {
            $rows[$key]['data'] = date('d/m/Y',strtotime($row['data']));
        }
      
        $dados['climas'] =  $rows;
        $dados['cidades'] =  $cidades->all();
        return view('clima',compact('dados'));
    }

    public function add(Request $request,Clima $clima,Cidade $cidade)
    {
        $c = $cidade->find($request->cidade_id);
        $temp = $clima->getClima($c->cidade);

        $dados = array(
            'data'=>$request->data,
            'cidade_id'=>$request->cidade_id,
            'maxima'=> $temp['main']['temp_max'],
            'minima'=> $temp['main']['temp_min'],
            'media'=> $temp['main']['temp'],
            'pressao'=> $temp['main']['pressure'],
            'umidade'=> $temp['main']['humidity']
        );

        if($request->id == ""){
            $clima->insert($dados);
            return response()->json(['msg'=>'Clima cadastrado com sucesso']); 
        }else{
            $clima->find($request->id)->update($dados);
            return response()->json(['msg'=>'Clima atualizado com sucesso']); 
        }
    }

    public function edit(Request $request,Clima $clima)
    {
        $dados = $clima->find($request->id);
        $dados['data'] = date('d/m/Y',strtotime($dados['data']));

        return response()->json($dados);
    }

    public function delete(Request $request,Clima $clima)
    {
        $clima->find($request->id)->delete();

        return response()->json(['msg'=>'Clima deletado com sucesso']); 
    }
}
