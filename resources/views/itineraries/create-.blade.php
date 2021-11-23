@extends('layouts.app')
 
@section('content')
<div class="py-4">
<div class="container">

<div class="form-group">
                        <label for="cc_number_id" class="form-label">Atsevišķa lauka izdabūšana</label>
                        <select class="form-control" name="cc_number_id" id="cc_number_id">
                            @foreach($data as $c)
                              <option value="{{ $c->id }}">{{$c->id}}</option>
                            @endforeach
                      </select>
</div>
<div class="form-group">
                        <label for="cc_number_id" class="form-label">Atsevišķa lauka izdabūšana</label>
                        <select class="form-control" name="cc_number_id" id="cc_number_id">
                            @foreach($data as $c)
                              <option value="{{ $c->id }}">{{$c->ti_nr}}</option>
                            @endforeach
                      </select>
</div>

<!-- autentificētā lietotāja pēdējā ceļazīme -->

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
                      <!-- @php($i = 1) -->
                      @foreach ($data as $value)
                <tr>
                    <td>{{ 1 }}</td>
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
                    
                    <a href="{{url('/car/edit/'.$value->id)}}" class="btn btn-secondary btn-sm">Labot</a>
                    <a href="{{url('/car/delete/'.$value->id)}}" onclick="return confirm('Vai tiešām dzēst?')" class="btn btn-secondary btn-sm">Dzēst</a>
                    
                    </td> 
                </tr> 
                      @endforeach
              </tbody>
            </table>

<!-- end autentificētā lietotāja pēdējā ceļazīme-->


</div>
</div>
</div>

<script>
 function totaldistance()
{
    var a1 = parseFloat(document.getElementById('odo_end').value);
    var a2 = parseFloat(document.getElementById('odo_start').value); 
     document.getElementById('total_distance_km').value = parseFloat(a1) - parseFloat(a2);
   }

   function avgfuel()
{
    var a1 = parseFloat(document.getElementById('odo_end').value);
    var a2 = parseFloat(document.getElementById('odo_start').value); 
    var a3 = parseFloat(document.getElementById('total_fuel_l').value);
    var a4 = 100;
     document.getElementById('fuel_average').value = (parseFloat(a3)/(parseFloat(a1)-parseFloat(a2))) * parseFloat(a4);
   }

   function concatan()
   {
    var str1 = document.getElementById('car_id').value;
    let ms = Date.now();
    var res = str1.concat(ms);
    document.getElementById('ti_nr').value = res;
   }
   

</script>

@endsection
