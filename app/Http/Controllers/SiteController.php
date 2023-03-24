<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tecnologia;
use App\Models\SiteContato;

class SiteController extends Controller
{
    public function index()
    {
        $tecnologias = Tecnologia::lista();
        return view('site.index', compact('tecnologias'));
    }

    public function enviar(Request $request)
    {
        $dados = $request->all();

        SiteContato::create($dados);

        dd($dados);
    }
}
