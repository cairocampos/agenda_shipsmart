<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function index()
    {
        return Estado::all();
    }
}
