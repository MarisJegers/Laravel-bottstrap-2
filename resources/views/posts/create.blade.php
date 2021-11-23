@extends('layouts.app')
  
@section('content')

<div class="row">
    <div class="col-sm-10"><h2>Pievienot jaunu ierakstu</h2></div>
    <div class="col-sm-2"><a class="btn btn-primary" href="{{ route('posts.index') }}"> Atpakaļ</a></div>
</div> 
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nosaukums:</strong>
                <input type="text" name="title" class="form-control" placeholder="Tēmas nosaukums te...">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tēma:</strong>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Rakstu darbs te..."></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Autors:</strong>
                <select class="form-control" name="user_id">
                    @foreach($user as $u)
                        <option value="{{ $u->id }}">{{$u->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Saglabāt</button>
        </div>
    </div>
   
</form>
@endsection