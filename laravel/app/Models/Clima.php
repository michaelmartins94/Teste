<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Clima extends Model
{
    use HasFactory;

    protected $table = 'climas';

    protected $fillable = [
        'id',
        'data',
        'cidade_id',
        'maxima',
        'minima',
        'media',
        'pressao',
        'umidade',
        'created_at',
        'updated_at'
    ];

    public function getAll()
    {
        return 
        $this->select('climas.*','cidades.cidade')
             ->leftJoin('cidades', 'cidades.id', '=', 'climas.cidade_id')
             ->orderby('climas.data','ASC')
             ->get();
    }

    public function getClimaCidade($cidade_id,$data)
    {
        return 
        $this->select('*')
             ->where('cidade_id','=',$cidade_id)
             ->where('data','=',$data)
             ->get();
    }

    public function createApi($clima)
    {
        $this->insert($clima);
    }

    public function getClima($cidade)
    {
        $url = 'http://api.openweathermap.org/data/2.5/weather?q=';
        $api_key ='&APPID=5e975f12e24a8b307fd2d539fb92f507';
        $endpoint = $url.$cidade.$api_key;

        $response = Http::post($endpoint);
        $response = json_decode($response->getBody(), true);

        return $response;
    }
}
