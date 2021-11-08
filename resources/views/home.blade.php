@extends('layouts.app')

@section('content')

  
   <div class="ml-48">Welcome <strong>{{ auth()->user()->name }}</strong></div>
       
   
    
@endsection
