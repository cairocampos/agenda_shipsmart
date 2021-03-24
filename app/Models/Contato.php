<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $connection = "mongodb";

    protected $fillable = [
        "nome",
        "email",
        "telefone",
        "cep",
        "bairro",
        "cidade",
        "logradouro",
        "numero",
        "estado"
    ];
}
