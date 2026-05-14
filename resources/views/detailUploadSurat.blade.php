@extends('components.main')
@include('layouts.head')
@include('components.navbar2staff')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-bold text-center text-[#344767]">DATA PENGAJUAN</h3>
        <div class="mt-6 border-t border-gray-200">
            <dl class="divide-y divide-gray-200 text-center">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">NO PENGAJUAN</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->id }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">NAMA</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->nama }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">NIM</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->nim }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">JURUSAN</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->jurusan }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">PRODI</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->prodi }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">JENIS ORMAWA</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->ormawa }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">ORMAWA</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->ketua_ormawa }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">PERIODE</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->periode }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">NO. TELP</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->telp }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">EMAIL</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->email }}</dd>
                    </div>
                </dl>
            </div>
    </div>
    @if ($pengajuans->berkas && $pengajuans->berkas->surat_pernyataan && $pengajuans->berkas->surat_perjanjian && $pengajuans->berkas->surat_mou !== 'pengaju belum mengirimkan file ini')
    <div class="bg-white shadow-lg rounded-lg p-6 my-8">
        <h2 class="text-2xl font-bold text-center text-[#344767] pb-6">BERKAS - BERKAS PENGAJU</h2>
        @foreach ($files as $title => $filename)
            @if ($filename)
                <h3 class="text-center text-xl font-bold text-[#344767] py-2 ">{{ $title }}</h3>
                <iframe class="mx-auto pb-10" src="{{ route('file.show', ['id' => $pengajuans->id, 'filename' => $filename]) }}" 
                        width="50%" height="600"></iframe>
            @endif
        @endforeach
    </div>
    {{-- <div class="bg-white shadow-lg rounded-lg p-6 my-8">
        <h2 class="text-2xl font-bold text-center text-[#344767]">SURAT - SURAT</h2>
        <div class="mb-10 mt-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2 ">Surat Pernyataan</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_surat_pernyataan.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Surat Perjanjian</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_surat_perjanjian.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Surat MoU</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_surat_mou.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Surat KAK</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_surat_kak.pdf') }}" width="50%" height="600px"></iframe>
        </div>
    </div> --}}
    @else
        <h3 class="text-2xl my-5 font-bold text-center text-[#344767]">PENGAJU BELUM MENGUPLOAD SEMUA SURAT - SURAT YANG DIHARUSKAN</h3>
    @endif


    <div class="flex justify-between items-center mt-4">
        <button class="bg-gradient-to-r from-[#FF7F00] to-[#FF9A36] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1">
            <a href="{{ route('listtable') }}">Kembali</a>
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<!-- Script to handle modal toggle (using Alpine.js) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
