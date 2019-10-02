<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urls;
use App\Bot;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $urls = Urls::all();

        $bots = array();
        foreach($urls as $key=>$val){
            $statusBot =   Bot::where('url_id', $val['id'])->orderBy('created_at', 'desc')->first();
            $bots[] = array('id' => $val['id'], 'urlNome' => $val['urlNome'], 'status' => $statusBot['status'], 'url' => $val['url'], 'created_at' => $val['created_at']);
        }

       
        return view('dashboard', compact('bots'));
    }

}
