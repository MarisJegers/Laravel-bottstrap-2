@extends('layouts.app')
 
@section('content')
<div class="conteiner">
    <div class="row justify-content-start">
      <div class="col-1"></div>
        <div class="col-4">
            <div class="card">
                <table class="table"> <h4>Meklēšanas rezultāts</h4>
                    <thead>
                        <tr>
                            <th scope="col">Apraksts</th>
                            <th scope="col">Pievienots</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($cc->isNotEmpty())
                            @foreach ($cc as $c)
                            <tr>
                                <td>{{ $c->cc_number }}</td>
                                <td>{{ $c->description }}</td>
                            </tr>
                            @endforeach
                        @else 
                            <div>
                                <h2>Nekas nav atrasts</h2>
                            </div>
                        @endif
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection