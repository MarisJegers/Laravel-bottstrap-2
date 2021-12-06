@extends('layouts.app')
 
@section('content')
       
    
<div class="container">
        <div class="row">
          <!-- Ieraksta pievienošanas poga -->
          <div align="right">
                <a class="btn btn-outline-dark btn-sm" href="{{ route('itineraries.create') }}"> Pievienot ierakstu</a>
          </div>
            
          <!-- ieraksta labošanas gadījumā, izleks paziņojums, ka tas veiksmīgi izdarīts -->
          @if(session('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>{{ session('success') }}</strong> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
                
                  
                  <h4>Ceļazīmju tabula</h4> 
                    
                  <!-- meklēšana -->
                    <form action="{{ route('itineraries.search') }}" method="GET">
                      <input type="text" name="search" required/>
                      <button type="submit" class="btn btn-outline-dark btn-sm">Meklēt</button>
                    </form>
                    <!-- end meklēšana-->
                    
        </div> <!-- pirmās rindas beigas-->         
                    
        <!-- rinda pašai tabulai-->
        <div class="row">
          <div class="column">
            <table class="table table-sm table-hover">
              <thead class="thead-light"><!-- tabulas virsraksta rinda -->
                <tr>
                  <th scope="col">Nr</th>
                  <th scope="col">CZ Nr.</th>
                  <th scope="col">Lietotājs</th>
                  <th scope="col">Auto</th>
                  <th scope="col">Sākuma dat.</th>
                  <th scope="col">Beigu dat.</th>
                  <th scope="col">KM-sākumā</th>
                  <th scope="col">KM-beigās</th>
                  <th scope="col">KM-nobraukts</th>
                  <th scope="col">Degviela l</th>
                  <th scope="col">Vid.degv.pat.</th>
                  <th scope="col">KM-darba</th>
                  <th scope="col">KM-privāti</th>
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
                    <td>{{ $value->ti_nr }}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>{{ $value->car->reg_nr }}</td>
                    <td>{{ $value->date_start  }}</td>
                    <td>{{ $value->date_end    }}</td>
                    <td>{{ $value->odo_start   }}</td>
                    <td>{{ $value->odo_end	 }}</td>
                    <td>{{ $value->total_distance_km  }}</td>
                    <td>{{ $value->total_fuel_l }}</td>
                    <td>{{ $value->fuel_average       }}</td>
                    <td>{{ $value->distance_business }}</td>
                    <td>{{ $value->distance_private }}</td>
                    <td>{{ $value->created_at->toDateString() }}</td>
                    <!-- Action pogas labajā malējā kolonā -->
                    <td> 
                    
                    <a href="{{url('/itinerary/edit/'.$value->id)}}" class="btn btn-secondary btn-sm">Labot</a>
                    <a href="{{url('/itinerary/delete/'.$value->id)}}" onclick="return confirm('Vai tiešām dzēst?')" class="btn btn-secondary btn-sm">Dzēst</a>
                    <a href="{{url('/itinerary/showitin/'.$value->id)}}" class="btn btn-secondary btn-sm">Skatīt</a>
                    </td> 
                </tr> 
                      @endforeach
              </tbody>
            </table>
          </div>
        </div><!-- end rinda pašai tabulai-->

          {{ $data->links() }} <!--šis, lai strādātu paginate -->
  
                    
            
</div>
          
          
          <!-- meklēšanas rezultāti -->
          
          <!-- end meklēšansa rezultāti -->
    
@endsection