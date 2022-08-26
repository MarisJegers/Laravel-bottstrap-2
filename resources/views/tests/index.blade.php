{{--tests/index.blade.php--}}
{{-- A;ert message: https://www.w3schools.com/howto/howto_js_alert.asp --}}

@extends('layouts.test')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }

  /* The alert message box */
.alert {
  padding: 20px;
  background-color: #99ff99; /* light green */
  color: #003300;
  margin-bottom: 15px;
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: #003300;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
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

   @if(session()->has('success'))
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      {{ session()->get('success') }} 
    </div>
   @endif
    
      <form method="post" action="{{ route('store.test') }}">
          @csrf
          <div class="form-group">
              <label for="tname">Vārds</label>
              <input type="text" 
                    class="form-control" 
                    name="tname"
                    {{--value="{{$test->tname}}"--}} />
          </div>
          <div class="form-group">
              <label for="tage">Vecums</label>
              <input type="number" 
                    class="form-control" 
                    name="tage"
                    {{--value="{{$test->tage}}"--}} />
          </div>
           <div class="form-group">
              <label for="tplace">Dzīvesvieta</label>
              <input type="text" 
                    class="form-control" 
                    name="tplace"
                    {{--value="{{$test->tplace}}"--}} />
          </div>
          <div class="form-group">
              <label for="tzip">Indekss</label>
              <input type="number" 
                    class="form-control" 
                    name="tzip"
                    {{--value="{{$test->tzip}}"--}} />
          </div>

           <div class="form-group">
              <label for="tdate">Datums</label>
              <input type="date" 
                    class="form-control" 
                    name="tdate"
                    {{--value="{{$test->tdate}}"--}} />
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
                                @php($i = 0)
                                @foreach ($data as $key => $value)
                          <tr>
                              <td>{{ ++$i }}</td>
                              <td>{{ $value->tname }}</td>
                              <td>{{ $value->tage }}</td>
                              <td>{{ $value->tplace }}</td>
                              <td>{{ $value->tzip }}</td>
                              <td>{{ $value->tdate }}</td>
                              <!-- Action pogas labajā malējā kolonā -->
                              <td> 
                              <a href="{{url('/tests/edit/'.$value->id)}}" {{--class="btn btn-secondary btn-sm"--}}><img src="{{url('/image/edit-25px.png')}}" alt="Labot"></a>
                              <a href="{{url('/tests/delete/'.$value->id)}}" onclick="return confirm('Vai tiešām dzēst?')" {{--class="btn btn-secondary btn-sm"--}} ><img src="{{url('/image/delete-25px.png')}}" alt="Dzēst"></a>
                              </td> 
                          </tr> 
                                @endforeach
                        </tbody>
                      </table>

          {{ $data->links() }} <!--šis, lai strādātu paginate -->

  </div> <!-- end card body-->
</div> <!-- end card uper-->

<script type="text/javascript"></script>
@endsection