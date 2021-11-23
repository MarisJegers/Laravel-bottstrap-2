@extends('layouts.app')
 
@section('content')
       
    
<div class="container">
        <div class="row">
            
          <!-- ieraksta labošanas gadījumā, izleks paziņojums, ka tas veiksmīgi izdarīts -->
          @if(session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>{{ session('success') }}</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
                  
                  <h4>Braucienu tabula</h4> 
                    
        </div> <!-- pirmās rindas beigas-->         
                    
        <!-- rinda pašai tabulai-->
        <div class="row">
          <div class="column">
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
                      @foreach ($data as $key => $value)
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
                    <!-- Action pogas labajā malējā kolonā -->
                    <td> 
                    
                    <a href="{{url('/journey/delete/'.$value->id)}}" onclick="return confirm('Vai tiešām dzēst?')" class="btn btn-secondary btn-sm">Dzēst</a>
                    
                    </td> 
                </tr> 
                      @endforeach
              </tbody>
            </table>
          </div>
        </div><!-- end rinda pašai tabulai-->

          {{ $data->links() }} <!--šis, lai strādātu paginate -->
            
</div>
          
    
@endsection