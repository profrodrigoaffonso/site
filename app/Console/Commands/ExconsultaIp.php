<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Contagem;

class ExconsultaIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consultaip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
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


    }
}
