@extends('layouts.app')
 
@section('content')
<div class="conteiner">
    <div class="row justify-content-start">
      <div class="col-1"></div>
        <div class="col-4">
            <div class="card">
                <table class="table"> <h4>Ceļazīmju meklēšanas rezultāts</h4>
                    <thead>
                        <tr>
                            <th scope="col">Baucējs</th>
                            <th scope="col">Auto</th>
                            <th scope="col">Datums</th>
                            <th scope="col">CZ numurs</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($users->isNotEmpty())
                            @foreach ($users as $c)
                            <tr>
                                <td>{{ $c->user->name }}</td> {{-- bija $c->user_id tas atgriež tikai lietotāja id skaitli --}}
                                <td>{{ $c->car->reg_nr }}</td>
                                <td>{{ $c->created_at }}</td>
                                <td>{{ $c->ti_nr }}</td>
                            </tr>
                            @endforeach
                        @elseif($cars->isNotEmpty())
                        @foreach ($cars as $c)
                        <tr>
                            <td>{{ $c->user->name }}</td> {{-- bija $c->user_id tas atgriež tikai lietotāja id skaitli --}}
                            <td>{{ $c->car->reg_nr }}</td>
                            <td>{{ $c->created_at }}</td>
                            <td>{{ $c->ti_nr }}</td>
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