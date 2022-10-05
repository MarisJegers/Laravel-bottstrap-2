<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailwind CSS Thank You Page </title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>

@if ($message = Session::get('success'))

<div class="w-full">
  <div class="flex items-center justify-between px-4 py-4 rounded text-slate-800 bg-green-300" role="alert">
      <strong class="mr-1">{{ $message }}</strong>
      <button class="bg-transparent text-2xl font-semibold leading-none outline-none focus:outline-none" onclick="closeAlert(event)">
    <span>×</span>

  </button>
  </div>
</div>

@endif


@if ($message = Session::get('error'))

<div class="alert alert-danger alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

        <strong>{{ $message }}</strong>

</div>

@endif


@if ($message = Session::get('warning'))

<div class="alert alert-warning alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	<strong>{{ $message }}</strong>

</div>

@endif


@if ($message = Session::get('info'))

<div class="alert alert-info alert-block">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	<strong>{{ $message }}</strong>

</div>

@endif


@if ($errors->any())

<div class="alert alert-danger">

	<button type="button" class="close" data-dismiss="alert">×</button>	

	Please check the form below for errors

</div>

@endif

<script>
  function closeAlert(event){
    let element = event.target;
    while(element.nodeName !== "BUTTON"){
      element = element.parentNode;
    }
    element.parentNode.parentNode.removeChild(element.parentNode);
  }
</script>
 </body>

</html>