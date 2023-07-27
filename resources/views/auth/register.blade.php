@extends('layouts.auth')

@section('content')
  <div class="bg-gray-100">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">      
      <div class="w-full rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 bg-white">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Sign up
          </h1>
          <form class="space-y-2 md:space-y-3" method="POST" action="{{ route('register.post') }}">
            @csrf
            <div>
              <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
              <input type="text" name="first_name" id="first_name" placeholder="Type your first name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 @error('first_name') border-red-400 @enderror" required value="{{ old('first_name') }}">
              @error('first_name')
                <div class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div>
              <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
              <input type="text" name="last_name" id="last_name" placeholder="Type your last name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 @error('last_name') border-red-400 @enderror" required value="{{ old('last_name') }}">
              @error('last_name')
                <div class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div>
              <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
              <input type="text" name="username" id="username" placeholder="Type your username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 @error('username') border-red-400 @enderror" required value="{{ old('username') }}">
              @error('username')
                <div class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
              <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 @error('email') border-red-400 @enderror" placeholder="Type your email address" required value="{{ old('email') }}">
              @error('email')
                <div class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
              <input type="password" name="password" id="password" placeholder="Create password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 @error('password') border-red-400 @enderror" required">
              @error('password')
                <div class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="pt-2">
              <button aria-label="Sign up" type="submit" class="w-full text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-2 focus:ring-gray-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Sign up
              </button>
            </div>
            <p class="text-sm font-light text-gray-500">
              Already have an account?
              <a href="/login" class="font-medium text-primary-600 hover:underline">
                Sign in
              </a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection