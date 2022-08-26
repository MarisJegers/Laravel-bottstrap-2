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
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
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
              <input type="number" 
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

<!-- tabula datu atgriešanai no db`zes-->

<div class="card uper">
  <div class="card-header">
    <h2>Tabula</h2>
  </div>
  <div class="card-body">

     <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Nr</th>
                            <th scope="col">Vārds</th>
                            <th scope="col">Vecums</th>
                            <th scope="col">Pilsēta</th>
                            <th scope="col">Indekss</th>
                            <th scope="col">Datums</th>
                            <th scope="col">Darbības</th>
                          </tr>
                        </thead>
                        <!-- te cikls ielasīs datus no BD tabulas -->
                        <tbody>
                               
                        </tbody>
                      </table>

          {{--{{ $data->links() }}--}} <!--šis, lai strādātu paginate -->

  </div> <!-- end card body-->
</div> <!-- end card uper-->


@endsection

{{--
 
--}}