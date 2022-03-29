@extends('layouts.app')

@section('content')
<div class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
    <div class="flex">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    {{ __('Set Your Password') }}
                </header>

                <div class="card-body">
                    <form method="POST" class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" action="{{ route('setpassword.store') }}">
                        @csrf

                        <div class="flex flex-wrap">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-input w-full @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="text-red-500 text-xs italic mt-4" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="flex flex-wrap">
                            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-input w-full" name="password_confirmation" required autocomplete="new-password">
                           
                        </div>

                        
                        <div class="flex flex-wrap">
                            <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                {{ __('Save Password') }}
                            </button>
                        </div>
                       
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection




