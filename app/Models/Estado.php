<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $connection = "mysql";

    protected $fillable = [
        "nome",
        "sigla"
    ];

    public $timestamps = false;
}
