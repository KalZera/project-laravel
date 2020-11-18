<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Provider;

class ProviderController extends Controller
{
    function register(Request $data){
        $cnpj = $data->all()['cnpj'];

        $cnpj = str_replace(".", "", $cnpj);
        $cnpj = str_replace("-", "", $cnpj);
        $cnpj = str_replace("/", "", $cnpj);

        $response = Http::get('https://www.receitaws.com.br/v1/cnpj/'.$cnpj);
        if($response->json()['status'] == 'ERROR'){
            return $response->json()['message'];
            return redirect('/home');
        }else{
            $company['nome'] = $response->json()['nome'];
            $company['main_activity'] = $response->json()['atividade_principal'][0]['text'];
            $company['register_in'] = $response->json()['abertura'];
            $company['cnpj'] = $response->json()['cnpj'];
            $company['user_id'] = auth()->user()['id'];
            $this->saveCompany($company);
            return redirect('/home');
        }
    }

    function saveCompany($company){
        return Provider::create([
            'name' => $company['nome'],
            'cnpj' => $company['cnpj'],
            'main_activity' => $company['main_activity'],
            'register_in' => $company['register_in'],
            'user_id' => $company['user_id'],
        ]);
    }

}