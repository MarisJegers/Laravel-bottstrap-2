{{--maps/create.blade.php v.2 ar centralizētu testa layout un tailwind.css--}}
{{-- Alert message: https://www.w3schools.com/howto/howto_js_alert.asp --}}

@extends('layouts.test')

@section('navbar')
   @parent <!-- Includes parent sidebar -->

@stop

@section('content')



<!--kaut kas līdzīgs bootstrap card-->
<div class="flex justify-center my-3">
  <div class="block p-9 rounded-lg shadow-lg bg-white max-w-sm">
    <h2 class="text-gray-900 text-xl leading-tight font-medium mb-2">Adreses pievienošana</h2>
  <div class="container mx-auto">
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
    
      <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" name="mapForm" onsubmit="return(validationFunc())" method="post" action="{{ route('store.maps') }}">
          @csrf
          <div class="mb-4">
              <label for="mname" class="block text-gray-700 text-sm font-bold mb-2">Vieta</label>
              <input type="text" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required"
                    name="mname"
                    {{--value="{{$test->tname}}"--}} 
                    onkeyup="enableSubmit()"/>
          </div>
          <div class="mb-4">
              <label for="maddress" class="block text-gray-700 text-sm font-bold mb-2">Adrese</label>
              <input type="text" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required" 
                    name="maddress"
                    {{--value="{{$test->tplace}}"--}} 
                    onkeyup="enableSubmit()"/>
          </div>
          <div class="mb-4">
              <label for="latitude" class="block text-gray-700 text-sm font-bold mb-2">Lat.</label>
              <input type="number" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required" 
                    name="latitude"
                    step="any"
                    {{--value="{{$test->tage}}"--}} 
                    onkeyup="enableSubmit()"/>
          </div>
          <div class="mb-4">
              <label for="longitude" class="block text-gray-700 text-sm font-bold mb-2">Lon.</label>
              <input type="number" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline required" 
                    name="longitude"
                    step="any"
                    {{--value="{{$test->tzip}}"--}} 
                    onkeyup="enableSubmit()"/>
          </div>

          <button type="submit" class="w-1/2 hover:w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" disabled>Pievienot</button>
      </form>
  </div>
</div>
</div>

<!-- tabula datu atgriešanai no db`zes-->


<div class="grid grid-cols-6 gap-4">
  <div class="col-start-3 col-span-2 rounded-md text-center bg-gray-900 font-semibold text-white p-2">Adrešu saraksts</div>
  
</div>
    

<!-- tailwind tabula start -->

      <div class="min-h-screen py-5">
        <div class='overflow-x-auto w-full'>
          
        <table class="mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
          <thead class="bg-gray-900">
            <tr class="text-white text-left">
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                <strong> Nr </strong>
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                <strong> Vieta </strong>
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                <strong> Adrese </strong>
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                <strong> Garums </strong>
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                <strong> Platums </strong>
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                <strong> Datums </strong>
              </th>
            </tr>
          </thead>
          <tbody>
                @php($i = 0)
                @foreach ($data as $key => $value)
            <tr class="bg-gray-100 border-b">

              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ ++$i }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->mname }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->maddress }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->latitude }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->longitude }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->created_at }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
         {{ $data->links() }} <!--šis, lai strādātu paginate -->
      </div>
    </div>
 


<!-- tailwind tabula end-->

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

  //function myNav() {
    //  var x = document.getElementById("myTopnav");
      //if (x.className === "topnav") {
        //x.className += " responsive";
      //} else {
        //x.className = "topnav";
      //}
    //}

</script>

@endsection