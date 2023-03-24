<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tecnologia;

class SiteController extends Controller
{
    public function index()
    {
        $tecnologias = Tecnologia::lista();
        return view('site.index', compact('tecnologias'));
    }
}
