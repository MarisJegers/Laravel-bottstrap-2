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
                        {{--<!--<a href="{{ route('posts.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Uzziņas. Kā tas viss strādā</button></a> <br> 
                        <a href="{{ route('costcenters.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Izmaksu centri</button></a> <br>
                        <a href="{{ route('cars.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Transports</button></a> <br>
                        <a href="{{ url('/underconstruction') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Objektu kodi</button></a> <br>
                        <a href="{{ route('itineraries.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Visas ceļazīmes</button></a> <br>
                        <a href="{{ route('itineraries.create') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Pievienot ceļazīmi un braucienus</button></a> <br>
                        <a href="{{ route('journeys.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Visi braucieni</button></a> <br>
                        <a href="{{ url('/register') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Pievienot lietotāju</button>Pievienot lietotāju</a> <br>
                        <a href="{{ route('employees.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Visi darbinieki</button></a> <br>
                        <a href="{{ route('companies.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Visi uzņēmumi</button></a> <br>
                        <a href="{{ route('signatures.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Signature</button></a>-->--}}
                        {{--<table class="table table-borderless" style="table-layout: fixed; width: 100%;">
                          <tbody>
                            <tr>
                              <td style="width:33%;"><a href="{{ route('posts.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block my-2">Uzziņas. Kā tas viss strādā</button></a></td>
                              <td style="width:33%;"><a href="{{ route('costcenters.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block my-4">Izmaksu centri</button></a></td>
                              <td style="width:33%;"><a href="{{ route('cars.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block py-4">Transports</button></a></td>
                            </tr>
                            <tr>
                              <td style="width:33%;"><a href="{{ url('/underconstruction') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Objektu kodi</button></a></td>
                              <td style="width:33%;"><a href="{{ route('itineraries.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Visas ceļazīmes</button></a></td>
                              <td style="width:33%;"><a href="{{ route('itineraries.create') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Pievienot ceļazīmi un braucienus</button></a></td>
                            </tr>
                            <tr>
                              <td style="width:33%;"><a href="{{ route('journeys.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Visi braucieni</button></a></td>
                              <td style="width:33%;"><a href="{{ url('/register') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Pievienot lietotāju</button></a></td>
                              <td style="width:33%;"><a href="{{ route('employees.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Visi darbinieki</button></a></td>
                            </tr>
                            <tr>
                                <td style="width:33%;"><a href="{{ route('companies.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Visi uzņēmumi</button></a></td>
                                <td style="width:33%;"><a href="{{ route('signatures.index') }}"><button type="button" class="btn btn-secondary btn-lg btn-block">Signature</button></a></td>
                                <td></td>
                            </tr>
                          </tbody>
                        </table>--}}

<!--izmēģinājums ar linku pārveidošanu par pogām-->

                        <a class="saite poga" href="{{ route('posts.index') }}">Uzziņas. Kā tas viss strādā</a> 
                        <a class="saite poga" href="{{ route('costcenters.index') }}">Izmaksu centri</a>
                        <a class="saite poga" href="{{ route('cars.index') }}">Transports</a> 
                        <a class="saite poga" href="{{ url('/underconstruction') }}">Objektu kodi</a>
                        <a class="saite poga" href="{{ route('itineraries.index') }}">Visas ceļazīmes</a>
                        <a class="saite poga" href="{{ route('itineraries.create') }}">Pievienot ceļazīmi un braucienus</a>
                        <a class="saite poga" href="{{ route('journeys.index') }}">Visi braucieni</a>
                        <a class="saite poga" href="{{ url('/register') }}">Pievienot lietotāju</a> 
                        <a class="saite poga" href="{{ route('employees.index') }}">Visi darbinieki</a> 
                        <a class="saite poga" href="{{ route('companies.index') }}">Visi uzņēmumi</a>
                        <a class="saite poga" href="{{ route('signatures.index') }}">Signature</a>
                        <a class="saite poga" href="{{ route('maps.index') }}">Testa UZDEVUMI</a>

<!--end izmēģinājums linkiem-->


                        {{--<p class="center">This paragraph will be red and center-aligned.</p>
                        <p class="center large">This paragraph will be red, center-aligned, and in a large font-size.</p> --}}

        {{--<div class="col-container" style="display: flex;  width: 100%;">
          <div class="col" style="background:black; flex: 1; padding: 10px;
          margin: 5px; ">
            <h2>
                <a href="{{ route('posts.index') }}" style="color: white;">Uzziņas. Kā tas viss strādā</a>
            </h2>
            
          </div>

          <div class="col" style="background:yellow; flex: 1;
          padding: 10px;
          margin: 5px;">
            <h2>Column 2</h2>
            <p>Hello World!</p>
            <p>Hello World!</p>
            <p>Hello World!</p>
            <p>Hello World!</p>
          </div>

          <div class="col" style="background:orange; flex: 1;
          padding: 10px;
          margin: 5px;">
            <h2>Column 3</h2>
            <p>Some other text..</p>
            <p>Some other text..</p>
          </div>
        </div>--}}




                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{--Lai pievienotu css klasi, html tegā to raksata uzreiz ai tega nosaukuma, piem., p class--}}
<style >
.list {
    display: flex;
    flex-wrap: wrap;
}
.list-item {
    display: flex;
    margin-bottom: 20px;
}
.list-content {
    width: 100%;
    background-color: #ccc;
    padding: 10px;
}
</style>