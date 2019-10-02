<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Urls;
use App\Bot;

class ControladorUrls extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
            'urlNome' => 'required|unique:urls',
            'url'     => 'required|regex:/^http(s)?:\/\/\w+(\.\w+)*(:[0-9]+)?\/?$/'
        ];

        $messages = [
            'urlNome.required' => 'O campo Nome é obrigatório',
            'urlNome.unique'   => 'Nome já cadastrado no base de dados',
            'url.required'     => 'O campo URL é obrigatório',
            'url.regex'        => 'A URL informada é inválida'
        ];

        $request->validate($rules, $messages);

        $url = new Urls();
        $url->urlNome = $request->input('urlNome');
        $url->url  = $request->input('url');

        $url->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $url = Urls::find($id);
       
        if(isset($url)){
            return view('editar', compact('url'));
        }else{
            return view('/');
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $rules = [
            'urlNome' => 'required|unique:urls,id,'.$id,
            'url'     => 'required|regex:/^http:\/\/\w+(\.\w+)*(:[0-9]+)?\/?$/'
        ];

        $messages = [
            'urlNome.required' => 'O campo Nome é obrigatório',
            'urlNome.unique'   => 'Nome já cadastrado no base de dados',
            'url.required'     => 'O campo URL é obrigatório',
            'url.regex'        => 'A URL informada é inválida'
        ];

        $request->validate($rules, $messages);


               
        $url = Urls::find($id);


        if(isset($url)){
            $url->urlNome = $request->input('urlNome');
            $url->url  = $request->input('url');
            $url->save();
           
        }else{
            return view('/');
        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $url = Urls::find($id);

        if(isset($url)){
            $url->delete();
        }else{
            return view('/');
        }

        return redirect('/');
    }
}
