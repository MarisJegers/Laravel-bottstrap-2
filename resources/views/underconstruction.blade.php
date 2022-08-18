@extends('layouts.app')

@section('content')


<div class="aaaa" id="this is working labi">
    
      
  <div class="headerx">
    <h1 class="display-4">Lapa izstrādes stadijā</h1>
    <button onclick="window.location.href='/home'">Uz sākumu</button>
  </div>
</div>


 
@endsection




{{-- 
  @push('css')
<link rel="stylesheet" href="/public/css/stylesheet.css">
<div class="container">
    
    <div class="row justify-content-center">

<h1 class="display-1" class="text-center">{{ __('Lapa izstrādes stadijā') }}</h1>
        <p class="pcolor">Teksts no p tage</p>

</div>
</div>
@endpush

<div class="d-flex align-items-center justify-content-center bg-success" style="height:200px">
       <h1>This is an example content</h1>
 </div>


<div class="aaaa" id="this is working labi">
    
      <h1 class="pcolor" class="text-center">{{ __('Lapa izstrādes stadijā') }}</h1>
    
</div> 


--}}
