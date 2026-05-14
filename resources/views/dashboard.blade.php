@extends('components.main')
@include('layouts.head')
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
@include('components.navbar2staff')

@section('content')
    <div class="w-full px-4 py-6 mx-auto" id="content">
        <!-- Grid dengan Kolom Khusus -->
        <div class="custom-grid  gap-4">

            <!-- Kotak Hijau -->
            <div class="kotak-hijau relative flex flex-col justify-between h-48 flex-grow bg-green-500">
                <h2 class="text-2xl font-bold text-white">Sudah <br> Mengajukan</h2>
                <p class="text-7xl font-bold text-left">{{ $sudahMengajukan }}</p>
            </div>
        
            <!-- Kotak Merah -->
            <div class="kotak-merah relative flex flex-col justify-between h-48 flex-grow bg-red-500">
                <h2 class="text-2xl font-bold text-white">Belum <br> Mengajukan</h2>
                <p class="text-7xl font-bold text-left">{{ $belumMengajukan }}</p>
            </div>
        
            <!-- Kotak Oranye -->
            <div class="kotak-oranye h-48 w-full md:w-auto bg-orange-500 order-3 md">
                <a href="{{ url('/listtable') }}" class="block text-2xl md:text-4xl font-bold text-left p-4 text-white">
                    Lihat Semua Pengajuan <br> ORMAWA
                </a>
            </div>
        </div>     

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <!-- Dalam Antrean dan Sudah Berhasil -->
            <div class="space-y-4">
              @php
                $maxVisible = 6;
                $totalAntrean = $profilAntrean->count();
                $totalBerhasil = $profilBerhasil->count();
                $extraAntrean = $totalAntrean - $maxVisible;
                $extraBerhasil = $totalBerhasil - $maxVisible;
              @endphp
                <h2 class="text-xl font-bold">Dalam Antrean</h2>
                <div class="flex-container">
                    @foreach ($profilAntrean->take($maxVisible) as $profil)
                    <div class="relative group inline-block">
                        <!-- Circle with initials -->
                        <div class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center cursor-pointer">
                            {{ strtoupper(substr($profil->nama, 0, 2)) }}
                        </div>

                        <!-- Tooltip -->
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-xs text-white bg-gray-800 rounded-lg py-1 px-2 shadow-lg">
                            {{ $profil->nama }}
                        </div>
                    </div>
                    @endforeach
                    @if ($extraAntrean > 0)
                        <div class="w-10 h-10 bg-gray-300 text-gray-700 rounded-full flex items-center justify-center text-xs font-semibold">
                            +{{ $extraAntrean }}
                        </div>
                    @endif
                </div>

                <h2 class="text-xl font-bold mt-4">Sudah Berhasil</h2>
                <div class="flex-container mb-4">
                    @foreach ($profilBerhasil->take($maxVisible) as $profil)
                    <div class="relative group inline-block">
                        <!-- Circle with initials -->
                        <div class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center cursor-pointer">
                            {{ strtoupper(substr($profil->nama, 0, 2)) }}
                        </div>

                        <!-- Tooltip -->
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-xs text-white bg-gray-800 rounded-lg py-1 px-2 shadow-lg">
                            {{ $profil->nama }}
                        </div>
                    </div>
                    @endforeach
                    @if ($extraBerhasil > 0)
                        <div class="w-10 h-10 bg-gray-300 text-gray-700 rounded-full flex items-center justify-center text-xs font-semibold">
                            +{{ $extraBerhasil }}
                        </div>
                    @endif
                </div>

                <!-- Tombol di Bawah Sudah Berhasil -->
                <div class="flex gap-4">
                    <a href="{{ url('/admin') }}" class="block text-center bg-gradient-to-r from-[#2E7BCE] to-[#173E68] text-white text-lg font-bold py-3 rounded-lg hover:opacity-90 transition w-1/2">
                        Atur Timeline
                    </a>
                    <div x-data="{ openModal: false }" class="w-1/2">
                        <!-- Button to trigger the modal -->
                        <button @click="openModal = true" class="block text-center bg-gradient-to-r from-[#2E7BCE] to-[#173E68] text-white text-lg font-bold py-3 rounded-lg hover:opacity-90 transition w-full">
                            Setting Akhir Pengajuan
                        </button>

                        <!-- Modal -->
                        <div class="fixed inset-0 z-50 flex items-center justify-center"
                            x-show="openModal"
                            x-cloak
                            @click.self="openModal = false">
                            <!-- Modal Content -->
                            <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-auto">
                                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                                    <h5 class="text-lg font-semibold" id="exampleModalLabel">Batas Dari Pengajuan</h5>
                                    <button type="button" @click="openModal = false" class="text-gray-500 hover:text-gray-700">
                                        &times;
                                    </button>
                                </div>
                                <form action="{{ route('update.access.time') }}" method="POST">
                                    @csrf
                                    <!-- Hidden input to set the rejection status -->
                                    <input type="hidden" name="status" value="Ditolak">
                                    <div class="w-full px-4 py-3">
                                        <label for="submission_start_time" class="form-label">Buka Pengajuan</label>
                                            <input type="date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                                id="submission_start_time" name="submission_start_time"
                                                value="" required>
                                        <label for="submission_end_time" class="form-label">Penutupan Pengajuan</label>
                                            <input type="date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                                id="submission_end_time" name="submission_end_time"
                                                value="" required>
                                    </div>
                                    <div class="flex justify-end px-4 py-3 border-t border-gray-200">
                                        <button type="button" @click="openModal = false" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                                            Close
                                        </button>
                                        <button type="submit" class="ml-2 px-4 py-2 text-black bg-red-500 rounded-md hover:bg-red-600">
                                            Set Deadline
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Foto Gedung Polban -->
            <div class="w-full rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('assets/img/polban.jpg') }}" alt="Gedung Polban" class="gambar-gedung w-full h-80 object-cover">
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
@endsection
