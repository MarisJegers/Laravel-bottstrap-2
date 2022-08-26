{{--tests/edit.blade.php--}}

@extends('layouts.test')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }

  
</style>


<div class="card uper">
  <div class="card-header">
    <h2>Labošana</h2>
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
    @if(session()->get('success'))
    <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      {{ session()->get('success') }} 
    </div>
    <br />
  @endif
    
    
      <form name="testForm" onsubmit="return(validationFunc())" method="post" action="{{ url('/tests/update/'.$test->id ) }}">
          @csrf
          <div class="form-group">
              <label for="tname">Vārds</label>
              <input type="text" 
              		class="form-control" 
              		name="tname"
                  id="tname" 
              		value="{{$test->tname}}" 
                  maxlength ="25"
                  />
          </div>
          <div class="form-group">
              <label for="tage">Vecums</label>
              <input type="number" 
              		class="form-control" 
              		name="tage"
                  id="tage" 
              		value="{{$test->tage}}" 
                  {{--min="1" max="102"--}}/>
          </div>
           <div class="form-group">
              <label for="tplace">Dzīvesvieta</label>
              <input type="text" 
              		class="form-control" 
              		name="tplace"
              		value="{{$test->tplace}}" 
                  minlength="2" 
                  maxlength="25"
                  size="30"/>
          </div>
          <div class="form-group">
              <label for="tzip">Indekss</label>
              <input type="number" 
              		class="form-control" 
              		name="tzip"
                  id="tzip" 
              		value="{{$test->tzip}}" 
                  {{--min="1000" max="9999"--}}/>
          </div>

           <div class="form-group">
              <label for="tdate">Datums</label>
              <input type="date" 
              		class="form-control" 
              		name="tdate"
              		value="{{$test->tdate}}" 
                  min="1979-12-31"
                  max="2024-12-31"/>
          </div>
          <button type="submit" class="btn btn-primary" >Labot</button> <!--  onclick=paarbaude()  īsti nestrādā-->
      </form>
  </div>
</div>

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
