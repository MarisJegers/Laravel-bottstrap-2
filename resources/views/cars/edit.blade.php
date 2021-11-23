@extends('layouts.app')
 
@section('content')
<div class="py-12">
<div class="container">
<div class="row">

<!-- datu pievienošanas forma lapas labajā pusē -->
<div class="col-md-9">
            <div class="card">
              <!-- ieraksta pievienošanas gadījuā, izleks paziņojums, ka tas veiksmīgi izdarīts -->
              @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
              <div class="card-header"> <h4>Transporta līdzekļa datu labošana</h4> </div>
                <div class="card-body">
                  
                   <form action="{{url('/car/update/'.$data->id)}}" method="POST">  
                    @csrf
                    <div class="mb-9">
                      <div class="form-group">
                        <label for="reg_nr" class="form-label">Valsts reģistrācijas numurs</label>
                        <input type="text" name="reg_nr" class="form-control" id="reg_nr" 
                        value="{{ $data ->reg_nr }}">
                        @error('reg_nr')<!-- ja validācija dod kļūdu -->
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                        
                      <div class="form-group">
                        <label for="make" class="form-label">Marka</label>
                        <input type="text" name="make" class="form-control" id="make" 
                        value="{{ $data ->make }}">
                        @error('make')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                        
                      <div class="form-group">
                        <label for="model" class="form-label">Modelis</label>
                        <input type="text" name="model" class="form-control" id="model" 
                        value="{{ $data ->model }}">
                        @error('model')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Degviela</label>
                        <select class="form-control form-control-sm" name='fuel_type' id="exampleFormControlSelect1">
                          <option>Dizeļdegviela</option>
                          <option>Benzīns</option>
                          <option>Elektrība</option>
                        </select>
                        @error('fuel_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="prod_year" class="form-label">Ražošanas gads</label>
                        <input type="number" name="prod_year" class="form-control" id="prod_year" 
                        value="{{ $data ->prod_year }}">
                        @error('prod_year')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="fuel_cons_factory" class="form-label">Ražotāja norādītais vidējais degvielas patēriņš (l/100 km)</label>
                        <input type="number" name="fuel_cons_factory" class="form-control" id="fuel_cons_factory" 
                        value="{{ $data ->fuel_cons_factory }}">
                        @error('fuel_cons_factory')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="purchase_date" class="form-label">Iegādes datums</label>
                        <input type="date" name="purchase_date" class="form-control" id="purchase_date" 
                        value="{{ $data ->purchase_date }}">
                        @error('purchase_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="cc_number_id" class="form-label">Izmaksu centrs</label>
                        <select class="form-control" name="cc_number_id" id="cc_number_id">
                            @foreach($costcenter as $cc)
                              <option value="{{ $cc->id }}">{{$cc->cc_number}}</option>
                          @endforeach
                      </select>
                        @error('cc_number_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="description" class="form-label">Skaidrojums</label>
                        <input type="text" name="description" class="form-control" id="description" 
                        value="{{ $data ->description }}">
                      </div>
                    </div>
                    @can('isAdmin')
                    <button type="submit" class="btn btn-primary">Saglabāt</button>
                    @endcan
                  </form>
              
                </div>
              </div>
            </div>
          </div>


</div>
</div>
</div>
@endsection
