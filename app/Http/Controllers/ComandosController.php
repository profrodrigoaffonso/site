<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ComandoAtual;

class ComandosController extends Controller
{
    public function atual()
    {
        $comando = ComandoAtual::atual();

        return $comando->comando;
    }
}
