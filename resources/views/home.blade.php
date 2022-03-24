@extends('layouts.app')
@section('title', 'Ceļazīmes')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ __('Infopanelis') }}</h3></div>
                    
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Sveiks, {{ Auth::user()->name }}
                    {{ __(', Tu esi veiksmīgi pieteicies sistēmā! ') }}
                    <p>Šodien ir: {!! \Carbon\Carbon::now()->format('d.m.Y') !!}</p> 
                    <h5>Saites:</h5>
                    @if (Auth::check())
                        <a href="{{ route('posts.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Uzziņas. Kā tas viss strādā</button></a> <br> 
                        <a href="{{ route('costcenters.index') }}">Izmaksu centri</a> <br>
                        <a href="{{ route('cars.index') }}">Transports</a> <br>
                        <a href="{{ url('/underconstruction') }}">Objektu kodi</a> <br>
                        <a href="{{ route('itineraries.index') }}">Visas ceļazīmes</a> <br>
                        <a href="{{ route('itineraries.create') }}">Pievienot ceļazīmi un braucienus</a> <br>
                        <a href="{{ route('journeys.index') }}">Visi braucieni</a> <br>
                        <a href="{{ url('/register') }}">Pievienot lietotāju</a> <br>
                        <a href="{{ route('employees.index') }}">Visi darbinieki</a> <br>
                        <a href="{{ route('companies.index') }}">Visi uzņēmumi</a> <br>
                        <a href="{{ route('signatures.index') }}">
                            <button type="button" class="btn btn-secondary btn-lg btn-block">Signature</button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
