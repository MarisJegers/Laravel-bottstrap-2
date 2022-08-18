@extends('layouts.app')
 
@section('content')
<div class="py-12">
<div class="container">
<div class="row">

<!-- datu pievienošanas forma lapas labajā pusē -->
<div class="col-md-9">
                    <div align="right">
                         <a class="btn btn-outline-dark btn-sm" href="{{ route('cars.index') }}"> Uz sarakstu</a>
                    </div>            
            <div class="card">
              <!-- ieraksta pievienošanas gadījuā, izleks paziņojums, ka tas veiksmīgi izdarīts -->
              @if(session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong> 
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
              <div class="card-header"> <h4>Pievienot transporta līdzekli</h4> </div>
                <div class="card-body">
                  <div><p>Svarīgi!!! Pirms pievieno automašīnu, pārliecinies vai pirms tam ir izveidots atbilstošais izmaksu centrs. </p></div>
                  <form action="{{route('store.car')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-9">
                      
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label for="reg_nr" class="form-label">Valsts reģistrācijas numurs</label>
                            <input type="text" name="reg_nr" class="form-control border border-dark" id="reg_nr" >
                            @error('reg_nr')<!-- ja validācija dod kļūdu -->
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="col-sm-4">
                            <label for="make" class="form-label">Marka</label>
                            <input type="text" name="make" class="form-control border border-dark bg-gray" id="make" >
                            @error('make')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="col-sm-4">
                            <label for="model" class="form-label">Modelis</label>
                            <input type="text" name="model" class="form-control border border-dark" id="model" >
                            @error('model')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>
                        
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-4">
                            <label for="exampleFormControlSelect1">Degviela</label>
                            <select class="form-control form-control-sm border border-dark" name='fuel_type' id="exampleFormControlSelect1">
                              <option>Dizeļdegviela</option>
                              <option>Benzīns</option>
                              <option>Elektrība</option>
                            </select>
                            @error('fuel_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        
                          <div class="col-sm-4">
                            <label for="prod_year" class="form-label">Ražošanas gads</label>
                            <input type="number" name="prod_year" class="form-control border border-dark" id="prod_year" placeholder="Piemēram: 2019">
                            @error('prod_year')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="col-sm-4">
                            <label for="purchase_date" class="form-label">Iegādes datums</label>
                            <input type="date" name="purchase_date" class="form-control border border-dark" id="purchase_date" >
                            @error('purchase_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                      </div>


                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="fuel_cons_factory" class="form-label">Ražotāja norādītais vidējais degvielas patēriņš (l/100 km)</label>
                            <input type="number" name="fuel_cons_factory" class="form-control border border-dark" id="fuel_cons_factory" step="any" placeholder="Piemēram: 6.8">
                            @error('fuel_cons_factory')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="col-sm-4">
                            <label for="cc_number_id" class="form-label">Izmaksu centrs</label>
                              <select class="form-control border border-dark" name="cc_number_id" id="cc_number_id" aria-describedby="emailHelp" >
                              <div id="emailHelp" class="form-text">Ierakstu izvēlies no saraksta</div>
                                  @foreach($costcenter as $c)
                                    <option value="{{ $c->id }}">{{$c->cc_number}}</option>
                                  @endforeach
                              </select>
                              @error('cc_number_id')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="description" class="form-label">Skaidrojums</label>
                        <input type="text" name="description" class="form-control border border-dark" id="description" >
                      </div>

                      <div class="form-group">
                        <label for="image" class="form-label">Pievienot attēlu</label>
                        {{--<input type="file" class="form-control border border-dark" name="image" placeholder="Choose image" id="image">--}}
                        <input type="file" id="photo" name="photo">
                          @error('image')
                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
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
