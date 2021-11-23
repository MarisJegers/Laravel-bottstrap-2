@extends('layouts.app')
  
@section('content')
    <!-- parāda vienas konkrētas ceļazīmes datus -->

<div class="container">
  <div class="row">
    <div class="column">
      <div class="card bg-light mt-3">
        <div class="card-header"><h4>Aktuālā ceļazīme Nr: {{$data->ti_nr}}</h4></div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">CZ numurs</th>
                <th scope="col">Izveidošanas datums</th>
                <th scope="col">Nobrauktais attālums</th>
                <th scope="col">Periods no</th>
                <th scope="col">Periods līdz</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">{{ $data->ti_nr }}</th>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->total_distance_km }}</td>
                <td>{{ $data->date_start }}</td>
                <td>{{ $data->date_end }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

      <!-- end parāda vienas konkrētas ceļazīmes datus -->


      <!-- braucienu pievienošanas forma-->

  <div class="row">
    <div class="column">
      <div class="card bg-light mt-3">
          <!-- ieraksta pievienošanas gadījuā, izleks paziņojums, ka tas veiksmīgi izdarīts -->
          @if(session('success'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          <div class="card-header"> <h4>Pievienot braucienu</h4> </div>
          <div class="card-body">
            <form action="{{route('store.journey')}}" method="POST">
              @csrf
              
              <div class="form-group">
                  <label for="ti_nr_id" class="form-label">Ceļazīmes numurs (lauks aizpildās automātiski)</label>
                  <input type="text" name="ti_nr_id" class="form-control" id="ti_nr_id" 
                  value="{{$data->id}}" data-toggle="tooltip" data-placement="top" title="!!! Lauks NAV jāaizpilda !!!" aria-describedby="emailHelp" readonly >
                      <div id="emailHelp" class="form-text">Ieraksts izveidojas automātiski. Nemainiet to!</div>
                  @error('ti_nr_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              
              <div class="form-group row">
                <div class="col">
                    <label for="date" class="form-label">Brauciena datums</label>
                    <input type="date" name="date" class="form-control" id="date" onblur="">
                    @error('date')<!-- ja validācija dod kļūdu -->
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
              
                <div class="col">
                  <label for="distance_km" class="form-label">Nobrauktais attālums (km)</label>
                  <input type="number" name="distance_km" class="form-control" id="distance_km" >
                  @error('distance_km')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              
              <div class="row">
              <div class="col">
                  <label for="position_start" class="form-label">Brauciena sākuma punkts</label>
                  <input type="text" name="position_start" class="form-control" id="position_start" >
                  @error('position_start')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

              <div class="col">
                  <label for="position_end" class="form-label">Brauciena beigu punkts</label>
                  <input type="text" name="position_end" class="form-control" id="position_end" onblur="">
                  @error('position_end')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              </div>

              <div class="form-group">
                  <label for="trip_target" class="form-label">Brauciena mērķis</label>
                  <input type="text" name="trip_target" class="form-control" id="trip_target">
              </div>

              <div class="form-group">
                  <label for="cc_number_id" class="form-label">Izvēlies izmaksu centru</label>
                  <select class="form-control" name="cc_number_id" id="cc_number_id">
                      @foreach($costcenter as $c)
                        <option value="{{ $c->id }}">{{$c->cc_number}}</option>
                      @endforeach
                  </select>
                  @error('car_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>
              
              <div class="form-check">
                <input class="form-check-input" type="radio" name="type_business" id="type_business" value="1" checked>
                <label class="form-check-label" for="type_business">
                  Darba brauciens
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="type_private" id="type_private" value="1">
                <label class="form-check-label" for="type_private">
                  Privāts brauciens
                </label>
              </div>
              
              <button type="submit" class="btn btn-primary">Saglabāt</button>
              
            </form>
          </div>
      </div>
    </div>
  </div>
  
    <!-- end braucienu pievienošanas forma-->

    <!-- Konkrētajai ceļazīmei pievienoto braucienu tabula-->

  <div class="row">
    <div class="column">
      <div class="card bg-light mt-3">
        <div class="card-header"><h4>Ceļazīmei pievienotie braucieni</h4></div>
          <div class="card-body">
            <table class="table table-sm table-hover">
              <thead class="thead-light"><!-- tabulas virsraksta rinda -->
                <tr>
                  <th scope="col">Nr</th>
                  <th scope="col">CZ Nr.</th>
                  <th scope="col">Datums</th>
                  <th scope="col">No</th>
                  <th scope="col">Uz</th>
                  <th scope="col">Mērķis</th>
                  <th scope="col">Attālums km</th>
                  <th scope="col">Izmaksas</th>
                  <th scope="col">Pievienots</th>
                  <th scope="col">Darbības</th>
                </tr>
              </thead>
              <!-- te cikls ielasīs datus no DB tabulas -->
              <tbody>
                      @php($i = 0)
                      @foreach ($journey as $key => $value)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $value->ti_nr_id }}</td>
                    {{--<td>{{ $value->user->name }}</td>--}}
                    <td>{{ $value->date  }}</td>
                    <td>{{ $value->position_start    }}</td>
                    <td>{{ $value->position_end   }}</td>
                    <td>{{ $value->trip_target	 }}</td>
                    <td>{{ $value->distance_km  }}</td>
                    <td>{{ $value->costcenter->cc_number }}</td>
                    <td>{{ $value->created_at->toDateString() }}</td>
                    <!-- Action poga labajā malējā kolonā -->
                    <td> 
                    
                    <a href="{{url('/journey/delete/'.$value->id)}}" onclick="return confirm('Vai tiešām dzēst?')" class="btn btn-secondary btn-sm">Dzēst</a>
                    
                    </td> 
                </tr> 
                      @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div><!--Konkrētajai ceļazīmei pievienoto braucienu tabula-->
</div>
          {{--{{ $journey->links() }}--}} <!--šis, lai strādātu paginate -->

  <!--Skripts tooltip uznirstošajam logam-->
<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
  })

</script>

@endsection