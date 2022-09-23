<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'nivel_mar',
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

}
