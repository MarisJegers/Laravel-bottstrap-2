@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="row">
        <div class="card">
              <!-- ieraksta pievienošanas gadījuā, izleks paziņojums, ka tas veiksmīgi izdarīts -->
              @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
              <div class="card-header"> <h4>Labot ceļazīmi</h4> </div>
                <div class="card-body">
                  
                  <form action="{{url('/itinerary/update/'.$data->id)}}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="user_id" class="form-label">Vadītājs</label>
                        <input type="text" name="user_id" class="form-control" id="user_id" value="{{Auth::user()->name}}">
                      </div>

                    <div class="form-group">
                        <label for="car_id" class="form-label">Izvēlies auto</label>
                        <select class="form-control" name="car_id" id="car_id">
                            @foreach($car as $c)
                              <option value="{{ $c->id }}">{{$c->reg_nr}}</option>
                            @endforeach
                        </select>
                        @error('car_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group row">
                      <div class="col">
                          <label for="date_start" class="form-label">Perioda sākuma datums</label>
                          <input type="date" name="date_start" class="form-control" id="date_start" 
                          value="{{ $data ->date_start }}">
                          @error('date_start')<!-- ja validācija dod kļūdu -->
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                    
                      <div class="col">
                        <label for="date_end" class="form-label">Perioda beigu datums</label>
                        <input type="date" name="date_end" class="form-control" id="date_end" 
                        value="{{ $data ->date_end }}">
                        @error('date_end')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    
                    <div class="row">
                    <div class="col">
                        <label for="odo_start" class="form-label">Odometrs perioda sākumā</label>
                        <input type="number" name="odo_start" class="form-control" id="odo_start" 
                        value="{{ $data ->odo_start }}">
                        @error('odo_start')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="odo_end" class="form-label">Odometrs perioda beigās</label>
                        <input type="number" name="odo_end" class="form-control" id="odo_end" onblur="totaldistance()"
                        value="{{ $data ->odo_end }}">
                        @error('odo_end')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>

                    <div class="form-group">
                      <label for="total_fuel_l" class="form-label">Izlietotā degviela (l)</label>
                      <input type="number" name="total_fuel_l" class="form-control" id="total_fuel_l" onblur="avgfuel()"
                      value="{{ $data ->total_fuel_l }}">
                      @error('total_fuel_l')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="total_distance_km" class="form-label">Nobrauktie kilometri (aprēķins fonā)</label>
                      <input type="number" name="total_distance_km" class="form-control" id="total_distance_km" 
                      value="{{ $data ->total_distance_km }}">
                      @error('total_distance_km')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="fuel_average" class="form-label">Aprēķinātais vidējais degvielas patēriņš (l/100 km)</label>
                      <input type="number" name="fuel_average" class="form-control" id="fuel_average" 
                      value="{{ $data ->fuel_average }}">
                      
                    </div>

                    <div class="form-group">
                    <label for="distance_business" class="form-label">Darba ietvaros veikto braucienu kopējā distance</label>
                    <input type="number" name="distance_business" class="form-control" id="distance_business" onblur="privatekm()"
                    value="{{ $data ->distance_business }}">
                    </div>

                    <div class="form-group">
                    <label for="distance_private" class="form-label">Privāto braucienu kopējā distance (aprēķins fonā)</label>
                    <input type="number" name="distance_private" class="form-control" id="distance_private" 
                    value="{{ $data ->distance_private }}">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Saglabāt</button>
                    
                  </form>
              
                </div>
              </div>
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
    var aa = (a3/(a1-a2))*a4;
    var aaa = aa.toFixed(2);
    document.getElementById('fuel_average').value = aaa;
   
     //te jāturpina lai skaitli noapaļo līdz 2 zīmēm aiz komata
   
    }

      
   function privatekm()
   {
    var a5 = parseFloat(document.getElementById('total_distance_km').value); 
    var a6 = parseFloat(document.getElementById('distance_business').value); 
    var a7 = a5 - a6;
    var a8 = a7.toFixed(2);
    document.getElementById('distance_private').value = a8;
   }

</script>



@endsection