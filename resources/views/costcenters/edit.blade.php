@extends('layouts.app')
 
@section('content')
       
    <div class="py-12">
      <div class="container">
        <div class="row">
          
          <!-- datu pievienošanas forma lapas labajā pusē -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header"><h4>Labot izmaksu centru</h4></div>
                <div class="card-body">
                  
                  <form action="{{url('/costcenter/update/'.$data->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="cc_number" class="form-label">Izmaksu centra numurs</label>
                        <input type="text" name="cc_number" class="form-control" id="cc_number"
                        value="{{ $data ->cc_number }}" >
                        @error('cc_number')<!-- ja validācija dod kļūdu -->
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <label for="description" class="form-label">Skaidrojums</label>
                        <input type="text" name="description" class="form-control" id="description" 
                        value="{{$data->description}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Saglabāt</button>
                  </form>
              
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection