{{--maps/create.blade.php v.2 ar centralizētu testa layout un w3.css--}}
{{-- Alert message: https://www.w3schools.com/howto/howto_js_alert.asp --}}

@extends('layouts.test')

@section('navbar')
   @parent <!-- Includes parent sidebar -->

@stop

@section('content')



<div class="w3-card w3-light-grey w3-margin w3-padding-large">
  <div class="w3-container">
    <h2>Adreses pievienošana</h2>
  </div>
  <div class="w3-container">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif

   @if(session()->has('success'))
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      {{ session()->get('success') }} 
    </div>
   @endif
    
      <form class="w3-container" name="mapForm" onsubmit="return(validationFunc())" method="post" action="{{ route('store.maps') }}">
          @csrf
          <div class="form-group">
              <label for="mname">Vieta</label>
              <input type="text" 
                    class="form-control required" 
                    name="mname"
                    {{--value="{{$test->tname}}"--}} 
                    onkeyup="enableSubmit()"/>
          </div>
          <div class="form-group">
              <label for="maddress">Adrese</label>
              <input type="text" 
                    class="form-control required" 
                    name="maddress"
                    {{--value="{{$test->tplace}}"--}} 
                    onkeyup="enableSubmit()"/>
          </div>
          <div class="form-group">
              <label for="latitude">Lat.</label>
              <input type="number" 
                    class="form-control required" 
                    name="latitude"
                    step="any"
                    {{--value="{{$test->tage}}"--}} 
                    onkeyup="enableSubmit()"/>
          </div>
          <div class="form-group">
              <label for="longitude">Lon.</label>
              <input type="number" 
                    class="form-control required" 
                    name="longitude"
                    step="any"
                    {{--value="{{$test->tzip}}"--}} 
                    onkeyup="enableSubmit()"/>
          </div>

          <button type="submit" class="btn btn-primary" disabled>Pievienot</button>
      </form>
  </div>
</div>

<!-- tabula datu atgriešanai no db`zes-->

<div class="w3-card w3-light-grey w3-margin w3-padding-large">
  <div class="w3-container">
    <h2>Adrešu saraksts</h2>
  </div>
  <div class="w3-container w3-mobile">

     <table class="w3-table-all">
        <thead>
          <tr class="w3-light-grey">
            <th scope="col">Nr</th>
            <th scope="col">Vieta</th>
            <th scope="col">Adrese</th>
            <th scope="col">Garums</th>
            <th scope="col">Platums</th>
            <th scope="col">Datums</th>
          </tr>
        </thead>
        <!-- te cikls ielasīs datus no BD tabulas -->
        <tbody>
                @php($i = 0)
                @foreach ($data as $key => $value)
          <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $value->mname }}</td>
              <td>{{ $value->maddress }}</td>
              <td>{{ $value->latitude }}</td>
              <td>{{ $value->longitude }}</td>
              <td>{{ $value->created_at }}</td>
          </tr> 
                @endforeach
        </tbody>
      </table>

          {{ $data->links() }} <!--šis, lai strādātu paginate -->

  </div> <!-- end card body-->
</div> <!-- end card uper-->

<script type="text/javascript">

function validationFunc() {    

  let mapForm = document.mapForm;
  //let pattern = new RegExp('^-?([1-8]?[1-9]|[1-9]0)\\.{1}\\d{1,6}');
  //ņemts no https://www.regextester.com/112728
  let pattern = /^(\-?([0-8]?[0-9](\.\d+)?|90(.[0]+)?)\s?[,]\s?)+(\-?([1]?[0-7]?[0-9](\.\d+)?|180((.[0]+)?)))$/;
  
  if(pattern.test(mapForm.latitude.value)) {
    alert("Nepareizi ievadītas koordinātas xx.xxxxx");
    return false;
  }
  if(pattern.test(mapForm.longitude.value)) {
    alert("Nepareizi ievadītas koordinātas xx.xxxxx");
    return false;
  }
  
  return (true);
}

//šis lai nevarētu nospiest submit pogu pirms visi ieraksti ir aizpildīti
//piemērs no https://websitemaintenance.medium.com/simple-javascript-to-disable-submit-button-until-input-fields-are-filled-in-ee9ec13906be

function enableSubmit(){

  let inputs = document.getElementsByClassName('required'); // Enter your class name for a required field, this should also be reflected within your form fields.
  //let btn = document.querySelector('input[type="submit"]');
  let btn = document.querySelector('button[type="submit"]');
  let isValid = true;
  for (var i = 0; i < inputs.length; i++){
  let changedInput = inputs[i];
  if (changedInput.value.trim() === "" || changedInput.value === null){
  isValid = false;
  break;
  }
  }
  btn.disabled = !isValid;
  }

  function myNav() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }

</script>

@endsection