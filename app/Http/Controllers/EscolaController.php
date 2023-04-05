<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aula;

class EscolaController extends Controller
{
    public function index()
    {
        $aulas = Aula::lista();
        return view('escola.index', compact('aulas'));
    }
}
