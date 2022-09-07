{{--maps/create.blade.php bez centralizēta layouta--}}
{{-- Alert message: https://www.w3schools.com/howto/howto_js_alert.asp --}}

{{--@extends('layouts.test')--}}

<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>TEST</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  
  <style>
  .uper {
    margin-top: 40px;
  }

  .card {
    margin: 50px;
  }

  /* The alert message box */
  .alert {
    padding: 20px;
    background-color: #99ff99; /* light green */
    color: #003300;
    margin-bottom: 15px;
  }

  /* The close button */
  .closebtn {
    margin-left: 15px;
    color: #003300;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  /* When moving the mouse over the close button */
  .closebtn:hover {
    color: black;
  }

  /* css navigācijas lentai maps.index, maps.create un layouts/test skatiem */
  .topnav {
    overflow: hidden;
    background-color: #333;
    
  }

  .topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .topnav a:hover {
    background-color: #ddd;
    color: black;
  }

  .topnav a.active {
    background-color: darkblue;
    color: white;
  }

  .topnav .icon {
    display: none;
  }

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}
/* END css topnav maps.index lapām */

</style>


</head>

<body style="background-color:darkslategrey;">

    <div class="topnav" id="myTopnav">
          <a href="{{ url('/') }}" class="active">Sākums</a>
          <a href="{{ route('maps.index') }}">Karte</a>
          <a href="{{ route('maps.create') }}">Adreses</a>
          <a href="{{ route('tests.index') }}">Forma</a>
          <a href="javascript:void(0);" class="icon" onclick="myNav()">
            <i class="fa fa-bars"></i>
          </a>
    </div>

{{--@section('content')--}}



<div class="card uper">
  <div class="card-header">
    <h2>Adreses pievienošana</h2>
  </div>
  <div class="card-body">
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
    
      <form name="mapForm" onsubmit="return(validationFunc())" method="post" action="{{ route('store.maps') }}">
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

<div class="card uper">
  <div class="card-header">
    <h2>Adrešu saraksts</h2>
  </div>
  <div class="card-body">

     <table class="table">
        <thead>
          <tr>
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

{{--@endsection--}}