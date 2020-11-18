@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">{{ __('Cadastro de fornecedor') }}</div>

            <div class="card-body">
               <form method="POST" action="{{route('registerprovider')}}">
                  @csrf
                  <div class="form-group row">
                     <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CNPJ') }}</label>
                     <div class="col-md-6">
                        <input id="cnpj" type="text" class="form-control @error('cnpj') is-invalid @enderror"
                           name="cnpj" value="{{ old('cnpj') }}" required autocomplete="name" autofocus>
                     </div>
                  </div>

                  <div class="form-group row mb-0">
                     <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                           {{ __('Cadastrar') }}
                        </button>
                     </div>
                  </div>
               </form>
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif

            </div>
         </div>
         @if (count($providers) > 0)
         <div class="row mt-5">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">{{ __('Lista de Fornecedores cadastrados') }}</div>

                  <div class="card-body">
                     @foreach($providers as $provider)
                     <div class="row">
                        <label for="name"
                           class="pl-2 col-form-label text-md-right text-uppercase">{{ $provider['name'] }}</label>
                     </div>
                     <div class=" row mb-2">
                        <label for="name" class="pl-2 col-form-label"><span
                              class="font-weight-bold">{{ $provider['cnpj'] }}
                              &nbsp</span>{{ __('CNPJ numero') }}</label>
                     </div>
                     <div class=" row mb-2">
                        <label for="name" class="pl-2 col-form-label"><span
                              class="font-weight-bold">{{ __('Atividade Principal') }}
                              &nbsp</span>{{ $provider['main_activity'] }}</label>
                     </div>
                     <div class=" row mb-2">
                        <label for="name" class="pl-2 col-form-label"><span
                              class="font-weight-bold">{{ __('Cadastrado em:') }}
                              &nbsp</span>{{ $provider['register_in'] }}</label>
                     </div>
                     <hr />
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
         @endif
      </div>
   </div>
</div>
</div>
@endsection