@extends('layouts.app')
 
@section('content')
@auth
    
    <div class="row">
        <div class="col-sm-10"><h2>Uzziņu lapa</h2></div>
        <div class="col-sm-2"><a class="btn btn-success" href="{{ route('posts.create') }}"> Pievienot ierakstu</a></div>
    </div> 
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Nr</th>
            <th>Nosaukums</th>
            <th>Apraksts</th>
            <th width="280px">Darbības</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $value->title }}</td>
            <td>{{ \Str::limit($value->description, 100) }}</td>
            <td>
                <form action="{{ route('posts.destroy',$value->id) }}" method="POST">   
                    <a class="btn btn-outline-dark btn-sm" href="{{ route('posts.show',$value->id) }}">Parādīt</a>    
                    <a class="btn btn-outline-dark btn-sm" href="{{ route('posts.edit',$value->id) }}">Rediģēt</a>   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-outline-dark btn-sm">Dzēst</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>  
    {!! $data->links() !!}      
    @endauth
    @endsection