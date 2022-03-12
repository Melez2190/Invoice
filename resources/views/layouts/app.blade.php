<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@routes  

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>{{ config('app.name', 'Quantox invoice') }}</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

   
    <!-- Scripts -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @yield('css')
    <!-- Styles -->
    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/css/app.css">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
<div id="app">
        <header class="bg-blue-900 py-6 sticky top-0 z-50">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span>{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>
       
<main class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex md:flex-row-reverse flex-wrap">
      
       <!--Main Content-->
       <div class="w-full md:w-4/5 bg-gray-100">
          <div class="container bg-gray-100 pt-16 px-6">
             
          </div>
       </div>
       
       <!--Sidebar-->
      @auth
          
       <div class="w-full md:w-44 mt-8 bg-gray-900 md:bg-gray-900 px-2 text-center fixed bottom-0  md:pt-8 md:top-8 md:left-0 h-16 md:h-screen md:border-r-4 md:border-gray-600">
          <div class="md:relative mx-auto lg:float-left lg:px-0">
             <ul class="list-reset flex flex-row md:flex-col text-center md:text-left">
                <li class="mr-3 flex-1">
                   <a href="/clients/create" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-white border-b-2 border-gray-800 md:border-gray-900 hover:border-blue-900">
                   <i class="fas fa-link pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block transform hover:scale-110 motion-reduce:transform-none ">Add new client</span>
                   </a>
                </li>
                <li class="mr-3 flex-1">
                   <a href="/invoices/create" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-white border-b-2 border-gray-800 md:border-gray-900 hover:border-blue-900">
                   <i class="fas fa-link pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block transform hover:scale-110 motion-reduce:transform-none ">Add new invoice</span>
                   </a>
                </li>
                <li class="mr-3 flex-1">
                   <a href="/clients" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-white border-b-2 border-gray-800 md:border-gray-900 hover:border-blue-900">
                   <i class="fas fa-link pr-0 md:pr-3 "></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600  md:text-gray-400 block md:inline-block transform hover:scale-110 motion-reduce:transform-none">List all client</span>
                   </a>
                </li>
                <li class="mr-3 flex-1">
                    <a href="/invoices" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-white border-b-2 border-gray-800 md:border-gray-900 hover:border-blue-900">
                    <i class="fas fa-link pr-0 md:pr-3 "></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600  md:text-gray-400 block md:inline-block transform hover:scale-110 motion-reduce:transform-none">List all invoices</span>
                    </a>
                 </li>
                <li class="mr-3 flex-1">
                   <a href="/user/statistics" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-pink-500 border-b-2 border-gray-800 md:border-gray-900 hover:border-pink-500">
                   <i class="fas fa-link pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block transform hover:scale-110 motion-reduce:transform-none">Profile</span>
                   </a>
                </li>
             </ul>
          </div>
       </div>
      @endauth

    </div>
</main>
        @yield('content')



    @yield('javascript')
    <script src="/js/app.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>