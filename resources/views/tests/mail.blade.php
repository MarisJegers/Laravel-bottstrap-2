{{-- mail.blade.php eksporta faila sūtīšanai formas input laukā ievadītajam adresātam--}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sūtīt adresātam</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">

  <!-- Font Awesome if you need it
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  -->
  <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/> 
  <!--Replace with your tailwind.css once created-->

</head>

<body class="font-sans antialiased text-gray-900 leading-normal tracking-wider bg-gray-300" >
  <div class="grid place-items-center h-screen">
      <div class="container mx-auto p-4 ">  
        <div class="px-6 text-gray-800 text-center">
        <div class="text-3xl">Lūdzu, ievadi e-pasta adresi.</div>
        <p>Uz to tiks aizsūtīts fails ar datiem no datubāzes.</p> 
      </div>
    <div class="container mx-auto p-4 "> 
      <section class="">
         
          <div class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full w-full g-6">
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
            
            <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mt-6 md:mb-0">
              <form method="post" action="/mail">
                @csrf
                <!-- Email input -->
                <div class="w-full">
                  <input
                    type="text"
                    class="rounded-lg block w-full px-4 py-2 text-sm font-normal text-gray-500 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="exampleFormControlInput2"
                    placeholder="Adresāta e-pasta adrese"
                    name="sendto"/>
                </div>

                <!-- Password input -->
                <div class="text-center lg:text-left">

                  <input class="rounded-lg p-3 mt-3 text-upper text-gray-900 hover:bg-gray-600 hover:text-white" type="submit" value="Sūtīt">
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>