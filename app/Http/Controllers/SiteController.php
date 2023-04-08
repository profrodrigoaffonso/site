<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tecnologia;
use App\Models\SiteContato;
use App\Models\Cep;
use App\Models\Contagem;

class SiteController extends Controller
{
    public function index()
    {
        $tecnologias = Tecnologia::lista();
        Contagem::create([
            'ip' => $_SERVER ['REMOTE_ADDR']
        ]);
        return view('site.index', compact('tecnologias'));
    }

    public function enviar(Request $request)
    {
        $dados = $request->all();

        SiteContato::create($dados);

        return redirect('/#contact')->with('mensagem', 'Enviado com sucesso!');

    }

    public function cep(Request $request)
    {

        $dados = $request->all();

        $dados['cep'] = preg_replace("/[^0-9]/", "", $dados['cep']);;

        // $response = Cep::consultaCep($cep);

        // dd($response);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8000?cep=' . $dados['cep'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = json_decode(curl_exec($curl));

        $trata_endereco = explode('-', $response[0]);
        $response[0] = trim($trata_endereco[0]);

        $trata_bairro = explode('(', $response[1]);
        $response[1] = trim($trata_bairro[0]);

        $cidade_uf = explode('/', $response[2]);
        $response[2] = $cidade_uf[0];
        $response[4] = $cidade_uf[1];


        curl_close($curl);
        return ($response);

    }

    public function atualizaIp()
    {
        $contagens = Contagem::atualizaIp();


        foreach ($contagens as $contagem){


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://ip-api.com/json/' . $contagem->ip,
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

            Contagem::where('id', $contagem->id)->update([
                'pais'  => $response->country,
                'cidade'  => $response->city
            ]);

        }

        return true;

        // die('sss');


    }
}
