@extends('layouts.auth')

@section('content')
  <div class="bg-gray-100">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">      
      <div class="w-full rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 bg-white">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Sign in
          </h1>
          <form class="space-y-3 md:space-y-4" method="POST" action="{{ route('login.post') }}">
            @csrf
            <div>
              <label for="email_username" class="block mb-2 text-sm font-medium text-gray-900">Email/Username</label>
              <input type="text" name="email_username" id="email_username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Your email/username" required value="{{ old('email_username') }}">
            </div>
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
              <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 @error('password') border-red-400 @enderror" required>
              @error('password')
                <div class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="pt-2">
              <button type="submit" class="w-full text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-2 focus:ring-gray-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Sign in
              </button>
            </div>
            <p class="text-sm font-light text-gray-500">
              Don’t have an account yet?
              <a href="/register" class="font-medium text-primary-600 hover:underline">
                Sign up
              </a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection