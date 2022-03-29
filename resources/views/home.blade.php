{{-- @dd(auth()->user()->role_id) --}}
@if (auth()->user()->role_id == '1')
        @extends('layouts.app')
        @section('admin')
        <div class="w-full md:w-44 mt-8 bg-gray-900 md:bg-gray-900 px-2 text-center fixed bottom-0  md:pt-8 md:top-8 md:left-0 h-16 md:h-screen md:border-r-4 md:border-gray-600">
            <div class="md:relative mx-auto lg:float-left lg:px-0">
               <ul class="d-block list-reset flex flex-row md:flex-col text-center md:text-left">
                  <li class="mr-3 flex-1">
                     <a href="{{ route('tenants.index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-white border-b-2 border-gray-800 md:border-gray-900 hover:border-blue-900">
                     <i class="fas fa-link pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block transform hover:scale-110 motion-reduce:transform-none ">Tenants</span>
                     </a>
                  </li>
               </ul>
            </div>
         </div>

        @endsection
        
@elseif (auth()->user()->role_id == '2')
    @section('content')
    <div class="w-full md:w-44 mt-8 bg-gray-900 md:bg-gray-900 px-2 text-center fixed bottom-0  md:pt-8 md:top-8 md:left-0 h-16 md:h-screen md:border-r-4 md:border-gray-600">
        <div class="md:relative mx-auto lg:float-left lg:px-0">
           <ul class="d-block list-reset flex flex-row md:flex-col text-center md:text-left">
              <li class="mr-3 flex-1">
                 <a href="{{ route('clients.index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-white border-b-2 border-gray-800 md:border-gray-900 hover:border-blue-900">
                 <i class="fas fa-link pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block transform hover:scale-110 motion-reduce:transform-none ">Clients</span>
                 </a>
              </li>
              <li class="mr-3 flex-1">
                <a href="{{ route('invoices.index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-white border-b-2 border-gray-800 md:border-gray-900 hover:border-blue-900">
                <i class="fas fa-link pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-400 block md:inline-block transform hover:scale-110 motion-reduce:transform-none ">Invoices</span>
                </a>
             </li>
           </ul>
        </div>
     </div>

    @endsection

@endif



  
   
       
   
    

