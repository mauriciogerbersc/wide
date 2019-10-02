<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urls;
use App\Bot;

class BotControlador extends Controller
{

    /*
     Listar os bots
     */

    public function list(){

        $urls = Urls::all();
       
        $capturas = array();
        foreach($urls as $key=>$val){
            $status = $this->status_url($val['url']);
            $conteudo = $this->content_url($val['url']);
            /* bem simples. salva os dados no banco */
            $capturas[] = array('conteudo' => $conteudo, 'status' => $status, 'url_id' => $val['id']);
        }

        $this->salvar($capturas);
    }

    public function salvar($arr){
        foreach($arr as $key=>$val){
            $bot = new Bot();

            $bot->captura = $val['conteudo'];
            $bot->status  = $val['status'];
            $bot->url_id  = $val['url_id'];

            if($bot->save()){
                echo "Cadastrou no banco url : " . $val['url_id'];
            }
        }
    }

    public function content_url($url){
        $ch = curl_init();
        $timeout = 0;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $conteudo = curl_exec ($ch);
        return $conteudo;
        curl_close($ch);
    }

    public function status_url( $url ) {
        $timeout = 10;
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
        $http_respond = curl_exec($ch);
        $http_respond = trim( strip_tags( $http_respond ) );
        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        return $http_code;
        curl_close( $ch );
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Bot::find($id);

        print_r($data);
    }

}
