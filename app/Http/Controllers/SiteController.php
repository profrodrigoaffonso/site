<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tecnologia;
use App\Models\SiteContato;
use App\Models\Cep;

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

    public function cep($cep)
    {

        // $response = Cep::consultaCep($cep);

        // dd($response);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8000?cep=' . $cep,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl));


        curl_close($curl);
        dd($response);

    }
}
