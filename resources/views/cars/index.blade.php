@extends('layouts.app')
 
@section('content')
       
    <div class="py-12">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
                    <div align="right">
                         <a class="btn btn-outline-dark btn-sm" href="{{ route('cars.create') }}"> Pievienot ierakstu</a>
                    </div>
            <div class="card">
                    <!-- ieraksta pievienošanas gadījuā, izleks paziņojums, ka tas veiksmīgi izdarīts -->
              @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                  <!-- kods izmaksu centru tabulas skatam lapas kreisajā pusē -->
                  <div class="card-header"> <h4>Transporta līdzekļu tabula</h4> 
                    
                  <!-- meklēšana -->
                    <form action="{{ route('car.search') }}" method="GET">
                      <input type="text" name="search" required/>
                      <button type="submit" class="btn btn-outline-dark btn-sm">Meklēt</button>
                    </form>
                    <!-- end meklēšana-->
                    
                  </div>
                    <div class="card-body">
                      <!-- tabulas virsraksta rinda -->
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Nr</th>
                            <th scope="col">VRN</th>
                            <th scope="col">Marka</th>
                            <th scope="col">Modelis</th>
                            <th scope="col">Degviela</th>
                            <th scope="col">Ražots</th>
                            <th scope="col">Vid.degv.patēŗiņš</th>
                            <th scope="col">Pirkšanas datums</th>
                            <th scope="col">Izmaksu centrs</th>
                            <th scope="col">Informācija</th>
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
                              <td>{{ $value->reg_nr }}</td>
                              <td>{{ $value->make }}</td>
                              <td>{{ $value->model }}</td>
                              <td>{{ $value->fuel_type }}</td>
                              <td>{{ $value->prod_year }}</td>
                              <td>{{ $value->fuel_cons_factory }}</td>
                              <td>{{ $value->purchase_date }}</td>
                              <td>{{ $value->costcenter->cc_number }}</td>
                              <td>{{ $value->description }}</td>
                              <td>{{ $value->created_at->toDateString() }}</td>
                              <!-- Action pogas labajā malējā kolonā -->
                              <td> 
                              @can('isAdmin')
                              <a href="{{url('/car/edit/'.$value->id)}}" class="btn btn-secondary btn-sm">Labot</a>
                              <a href="{{url('/car/delete/'.$value->id)}}" onclick="return confirm('Vai tiešām dzēst?')" class="btn btn-secondary btn-sm">Dzēst</a>
                              @endcan
                              </td> 
                          </tr> 
                                @endforeach
                        </tbody>
                      </table>

                      {{ $data->links() }} <!--šis, lai strādātu paginate -->
  
                    </div>
          </div> 
      </div>
    </div>
@endsection