@extends('layouts.app')

@section('content')
  <div class="py-10 md:mx-12 flex-grow relative">
    <div class="mb-10 mx-20 max-sm:mx-10 max-lg:mx-12">
      <h1 class="text-2xl font-bold mb-1">About</h1>
      <p class="text-lg text-gray-700">✋ Hei {{ $user->username }}!</p>
      <div class="my-6 flex flex-col gap-4">
        <p class="text-md text-gray-500">
          Selamat datang di aplikasi Sistem Manajemen dan Pembelian Barang Sesajen yang telah dibuat oleh saya sebagai respon atas tantangan dari Roro kepada Bondowoso. Aplikasi ini bertujuan untuk membantu dalam mengatur dan memudahkan proses pembelian barang sesajen secara sederhana.
        </p>
        <p class="text-md text-gray-500">
          Jangan ragu untuk segera mencoba aplikasi ini. Saya harap aplikasi saya dapat memberikan manfaat dan kemudahan dalam proses pembelian barang sesajen bagi Anda dan Bondowoso.
        </p>
        <p class="text-md text-gray-500">
          Terima kasih telah bergabung dengan saya dalam menyelesaikan tantangan ini!
        </p>
        <p class="text-md text-gray-500">
          Salam, </br>
          Pengembang Aplikasi Sistem Manajemen dan Pembelian Barang Sesajen
        </p>
      </div>
    </div>
  </div>
  <style>
    .about {
      color: #3b82f6;
    }
  </style>
@endsection