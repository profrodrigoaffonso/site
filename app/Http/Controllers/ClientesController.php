<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function create()
    {
        return view('admin.clientes.create');
    }
}
