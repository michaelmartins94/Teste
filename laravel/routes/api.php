<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Clima;
use App\Models\Cidade;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/clima', function (Request $request,Clima $clima,Cidade $cidade) {
    
    $data = $request->data;

    $cidades = $cidade->all();
    $api_id = '&APPID=5e975f12e24a8b307fd2d539fb92f507';
    $url = 'http://api.openweathermap.org/data/2.5/weather?q=';

    foreach ($cidades as $c) {
        $row = $clima->getClimaCidade($c->id,$data);
        $endpoint = $url.$c->cidade.$api_id;
        
        if(count($row) > 0){
            $dados[$c->id] = $row;
        }else{
            if($data == date('Y-m-d')){
                $response = Http::post($endpoint);
                $response = json_decode($response->getBody(), true);
                
                $temp["data"]= $data;
                $temp["cidade_id"]= $c->id;
                $temp["maxima"]= $response['main']['temp_max'];
                $temp["minima"]= $response['main']['temp_min'];
                $temp["media"]= $response['main']['temp'];
                $temp["pressao"]= $response['main']['pressure'];
                $temp["umidade"]= $response['main']['humidity'];

                $dados[$c->id] = $temp;

                $clima->insert($temp);
            }else{
                return response()->json(['error'=>'Data não encontrada']);
            }
            
        }
    }
    return $dados;
});

