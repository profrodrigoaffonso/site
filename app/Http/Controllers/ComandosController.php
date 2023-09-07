<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ComandoAtual;
use App\Models\Contagem;

class ComandosController extends Controller
{
    public function financas(Request $request)
    {

        $dados = $request->all();

        print_r($dados);

        // return "sss";

    }

    public function atual()
    {
        $comando = ComandoAtual::atual();

        return $comando->comando;
    }

    public function atualizar(){

        $contagens = Contagem::select('ip')->where('cidade', null)->groupby('ip')->get();

        $sql = "";



        foreach($contagens as $contagem){
            // echo $contagem->ip . '<br>';

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

            $response = curl_exec($curl);
// dd($response);
            $dados = json_decode($response);
            // dd($dados);
            curl_close($curl);

            $sql .= "UPDATE contagens SET cidade = '{$dados->city}', pais = '{$dados->country}'
                        WHERE ip = '{$contagem->ip}';";

            echo $sql;
            /// die;
            // dd($dados);
            // echo $response;
        }


        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/atualizar.sql","wb");

        fwrite($fp,$sql);

        fclose($fp);

        die($sql);

    }
}
