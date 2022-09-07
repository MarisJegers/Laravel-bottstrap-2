{{--tests/index.blade.php v.2 ar tailwind cssu--}}
{{-- A;ert message: https://www.w3schools.com/howto/howto_js_alert.asp --}}

@extends('layouts.test')

@section('content')
<style>
  .uper {
    margin-top: 40px;
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
</style>

<!-- taiwind forma start-->
<div class="flex justify-center my-3">
<div class="block p-6 rounded-lg shadow-lg bg-white max-w-sm">
  <div class="container object-fill">
    <div class="flex items-center">
      <h2 class="text-gray-900 text-xl leading-tight font-medium mb-2">1.testa uzdevums. Forma datu pievienošanai</h2>
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
  <form method="post" action="{{ route('store.test') }}">
    @csrf
    <div class="form-group mb-6">
      <label for="tname" class="form-label inline-block mb-2 text-gray-700">Vārds</label>
      <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail1"
        aria-describedby="emailHelp" placeholder="Ievadi vārdu"
        name="tname">
      <!--<small id="emailHelp" class="block mt-1 text-xs text-gray-600">We'll never share your email with anyone
        else.</small>-->
    </div>
    <div class="form-group mb-6">
      <label for="tage" class="form-label inline-block mb-2 text-gray-700">Vecums</label>
      <input type="number" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
        placeholder="Vecums"
        name="tage">
    </div>
    <div class="form-group mb-6">
      <label for="tplace" class="form-label inline-block mb-2 text-gray-700">Dzīvesvieta</label>
      <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputEmail1"
        aria-describedby="emailHelp" placeholder="Pilsēta"
        name="tplace">
    </div>
    <div class="form-group mb-6">
      <label for="tzip" class="form-label inline-block mb-2 text-gray-700">Indekss</label>
      <input type="number" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
        placeholder="Indekss bez 'LV'"
        name="tzip">
    </div>
    <div class="form-group mb-6">
      <label for="tdate" class="form-label inline-block mb-2 text-gray-700">Datums</label>
      <input type="date" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
        placeholder="Izvēlies datumu"
        name="tdate">
    </div>
    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg w-1/2 hover:w-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Saglabāt</button>
  </form>
</div>
</div>
</div>


<!-- tailwind forma stop -->

<!-- tailwind tabula start-->

<div class="min-h-screen py-5">
        <div class='overflow-x-auto w-full'>
        <table class="mx-auto max-w-4xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
          <thead class="bg-gray-900">
            <tr class="text-white text-left">
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                Nr              
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                Vārds
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                Vecums
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                Pilsēta
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                Indekss
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                Datums
              </th>
              <th scope="col" class="font-semibold text-sm uppercase px-6 py-4">
                Darbības
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
                {{ $value->tname }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->tage }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->tplace }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->tzip }}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{ $value->tdate }}
              </td>
              <td> 
                <div class="container">
                  <div class="flex items-center">
                    <span class="p-2">
                      <a href="{{url('/tests/edit/'.$value->id)}}" {{--class="btn btn-secondary btn-sm"--}}><img src="{{url('/image/edit-25px.png')}}" alt="Labot"></a>
                    </span>
                    <span class="p-2">
                      <a href="{{url('/tests/delete/'.$value->id)}}" onclick="return confirm('Vai tiešām dzēst?')" {{--class="btn btn-secondary btn-sm"--}} ><img src="{{url('/image/delete-25px.png')}}" alt="Dzēst"></a>
                    </span>
                  </div>
                </div>                  
              </td> 

            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $data->links() }} <!--šis, lai strādātu paginate -->
      </div>
    </div>
 

<!-- tailwind tabula end -->>


<script type="text/javascript"></script>
@endsection