<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;

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
        return view('home',['providers'=>$this->searchForUser()]);
    }
    
    function searchForUser(){
        $user = auth()->user()->id;
        $providers = Provider::where('user_id', [$user])->get();
        $providerArray = [];
        foreach($providers as $key => $provider){
            // $teste = $provider['original'];
            $providerArray[$key]['name'] = $provider->name;
            $providerArray[$key]['cnpj'] = $provider->cnpj;
            $providerArray[$key]['main_activity'] = $provider->main_activity;
            $providerArray[$key]['register_in'] = $provider->register_in;
        }
        return $providerArray;
    }
}