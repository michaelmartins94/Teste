<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $table = 'cidades';

    protected $fillable = [
        'id',
        'cidade',
        'created_at',
        'updated_at'
    ];

}
