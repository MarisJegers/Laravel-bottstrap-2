{{--tests/edit.blade.php v.2 ar tailwind css--}}

@extends('layouts.test')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }

  
</style>

<!--taiwind forma start -->


<div class="flex justify-center my-3">
<div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
  <div class="container object-fill">
    <div class="flex items-center">
      <h2 class="text-gray-900 text-xl leading-tight font-medium mb-2">Ieraksta {{$test->tname}} labošana</h2>
    </div>
  </div>
  <div class="container object-fill">
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
   
    <div class="alert bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full alert-dismissible fade show" role="alert">
        <strong class="mr-1">{{ session()->get('success') }}</strong>
        <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
   @endif
  <form name="testForm" onsubmit="return(validationFunc())" method="post" action="{{ url('/tests/update/'.$test->id ) }}">
    @csrf
    <div class="form-group mb-6">
      <label for="tname" class="form-label inline-block mb-2 text-gray-700">Vārds</label>
      <input type="text" 
        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail1"
        aria-describedby="emailHelp" 
        name="tname"
        id="tname" 
        value="{{$test->tname}}" 
        maxlength ="25">
      <!--<small id="emailHelp" class="block mt-1 text-xs text-gray-600">We'll never share your email with anyone
        else.</small>-->
    </div>
    <div class="form-group mb-6">
      <label for="tage" class="form-label inline-block mb-2 text-gray-700">Vecums</label>
      <input type="number" 
        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
        name="tage"
        id="tage" 
        value="{{$test->tage}}" >
    </div>
    <div class="form-group mb-6">
      <label for="tplace" class="form-label inline-block mb-2 text-gray-700">Dzīvesvieta</label>
      <input type="text" 
        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail1"
        aria-describedby="emailHelp" placeholder="Pilsēta"
        name="tplace"
        id="tplace" 
        value="{{$test->tplace}}" 
        minlength="2" 
        maxlength="25"
        size="30">
    </div>
    <div class="form-group mb-6">
      <label for="tzip" class="form-label inline-block mb-2 text-gray-700">Indekss</label>
      <input type="number" 
        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
        name="tzip"
        id="tzip" 
        value="{{$test->tzip}}">
    </div>
    <div class="form-group mb-6">
      <label for="tdate" class="form-label inline-block mb-2 text-gray-700">Datums</label>
      <input type="date" 
        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
        placeholder="Izvēlies datumu"
        name="tdate"
        value="{{$test->tdate}}" 
        min="1979-12-31"
        max="2024-12-31">
    </div>
    <button type="submit" class="w-1/2 hover:w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150       ease-in-out">Labot</button>
  </form>
</div>
</div>
</div>


<!--tailwind forma stop-->



<script type="text/javascript">

let theForm = document.testForm;
  //let ree = /^[\w ]+$/;
  //let re = /[!@#$ %^&*()_+\-=\[\]{};'":\\|,.<>\/?]+/;
var letters = /^[A a Ā ā B b C c Č č D d E e Ē ē F f G g Ģ ģ H h I i Ī ī J j K k Ķ ķ L l Ļ ļ M m N n Ņ ņ O o P p R r S s Š š T t U u Ū ū V v Z z Ž ž]+$/;
  function validationFunc() {
  if (theForm.tname.value == "" ) {
      alert( "Vārds ir jāaizpilda" );
      theForm.tname.focus();
      return false;
  }

  //šis nestrādā
  if (theForm.tname.length > 25) {
      alert( "Vārds nedrīkst būt garāks par 25 zīmēm" );
      theForm.tname.focus();
      return false;
  }

      // pārbauda vai nesaturliekus simbolus
  if(!letters.test(theForm.tname.value)) {
    alert("Vārdā ievadīts nepieļaujams simbols");
    return false;
  }

  if (theForm.tage.value == "" ) {
      alert( "Dzīvesvieta ir jāaizpilda" );
      theForm.tname.focus();
      return false;
  }

  if(!letters.test(theForm.tplace.value)) {
    alert("Dzīvesvietas nosaukumā ievadīts nepieļaujams simbols");
    return false;
  }

 //indeksa pārbaude vai tas nav lielāks par 10k un mazāks par 1k un vai ir skaitlis 
  if(theForm.tzip.value < 1000 || theForm.tzip.value > 9999 || isNaN(theForm.tzip.value)){
    alert("Indekss. Ievadi skaitli no 1000 līdz 9999");
    return false;
  }

  //tas pats princips, kā ar indeksa pārbaudi
  if(theForm.tage.value < 1 || theForm.tage.value > 105 || isNaN(theForm.tage.value)){
    alert("Vecums. Ievadi skaitli no 1 līdz 105");
     return false;
  }

  return (true);
  }
  

</script>


@endsection
