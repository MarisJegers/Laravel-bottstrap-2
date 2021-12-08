@extends('layouts.app')
  
@section('content')
    <!-- parāda vienas konkrētas ceļazīmes datus -->

<div class="container">
  <div class="row">
    <div class="column">
      <div class="card bg-light mt-3">
        <div class="card-header">
            <h4>Aktuālā ceļazīme Nr: {{$data->ti_nr}}</h4>
            <h4>Transporta līdzekļa vadītājs: {{ $data->user->name }}</h4>
            <h4>Transporta līdzekļa numurs: {{ $data->car->reg_nr }}</h4>
            <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary" href="{{ URL::to('#') }}">Export to PDF</a>
                </div>
        </div>
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
                    {{--<td>{{ $value->ti_nr_id }}</td> --}}
                    <td>{{ $data->ti_nr }}</td>
                    {{--<td>{{ $value->travelitinerary->ti_nr }}</td> --}} 
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