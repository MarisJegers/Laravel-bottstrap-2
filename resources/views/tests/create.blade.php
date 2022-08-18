{{--create.blade.php--}}

@extends('layouts.test')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    <h2>Testa uzdevums</h2>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('store.test') }}">
          @csrf
          <div class="form-group">
              <label for="tname">Vārds</label>
              <input type="text" 
              		class="form-control" 
              		name="tname"
              		value="{{$test->tname}}" />
          </div>
          <div class="form-group">
              <label for="tage">Vecums</label>
              <input type="number" 
              		class="form-control" 
              		name="tage"
              		value="{{$test->tage}}" />
          </div>
           <div class="form-group">
              <label for="tplace">Dzīvesvieta</label>
              <input type="text" 
              		class="form-control" 
              		name="tplace"
              		value="{{$test->tplace}}" />
          </div>
          <div class="form-group">
              <label for="tzip">Indekss</label>
              <input type="text" 
              		class="form-control" 
              		name="tzip"
              		value="{{$test->tzip}}" />
          </div>

           <div class="form-group">
              <label for="tdate">Datums</label>
              <input type="date" 
              		class="form-control" 
              		name="tdate"
              		value="{{$test->tdate}}" />
          </div>
          <button type="submit" class="btn btn-primary">Pievienot</button>
      </form>
  </div>
</div>
@endsection