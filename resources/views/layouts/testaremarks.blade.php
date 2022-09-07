 {{--Strādājoš navbars, bet nedarbojas hamburgera poga, kad samazināts ekrāns--}}

 <nav class="border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
          <div class="container flex flex-wrap justify-left items-center mx-auto">
            
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
              <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 navbar-nav">
                {{--<li class="nav-item">
                  <a href="{{ url('/login') }}" class="nav-link show block py-2 pr-4 pl-3 bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Pieteikties</a>
                </li>--}}
                <li class="nav-item {{ (request()->is('maps/index')) ? 'active' : '' }}">
                  <a href="{{ route('maps.index') }}" class="nav-link show block py-2 pr-4 pl-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Karte</a>
                </li>
                <li class="nav-item {{ (request()->is('maps/create')) ? 'active' : '' }}">
                  <a href="{{ route('maps.create') }}" class="nav-link show block py-2 pr-4 pl-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Adreses</a>
                </li>
                <li class="nav-item {{ (request()->is('tests/index')) ? 'active' : '' }}">
                  <a href="{{ route('tests.index') }}" class="nav-link show block py-2 pr-4 pl-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Forma</a>
                </li>
              </ul>

            </div>
            <!--<div class="flex space-x-2 items-center">
              <a href="{{ url('/login') }}" class="text-gray-800 text-sm">LOGIN</a>-->
              <!--<a href="#" class="bg-indigo-600 px-4 py-2 rounded text-white hover:bg-indigo-500 text-sm">SIGNUP</a>-->
            <!--</div>-->
    
            {{--<div class="ml-auto inline-block align-middle">--}}
              {{--<div class="nav-item">--}}
                  {{--<a href="{{ url('/login') }}" class="nav-link show block bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white">PIETEIKTIES</a>--}}
                {{--</div>--}}
            {{--</div>--}}
          </div>
      </nav>