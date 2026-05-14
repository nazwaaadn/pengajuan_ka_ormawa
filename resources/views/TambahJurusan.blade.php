@extends('components.main')
@include('layouts.head')
@include('components.navbar2staff')

@section('content')
<div class="w-full px-4 py-6 mx-auto" id="content">
    <div class="relative shadow-md rounded-lg overflow-hidden mb-5 p-5 border border-gray-200 bg-white">
        <h2 class="text-xl font-bold pb-2">Tambah Jurusan</h2>
        <form action="{{ route('jurusan.store') }}" method="POST" class="flex flex-col items-center">
            @csrf
            <div class="mb-4 w-full max-w-lg">
                <label for="nama_jurusan" class="block font-bold text-[#295F98] mb-2">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <button type="submit" class="bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1 mt-4">Simpan</button>
        </form>
    </div>

    <div class="relative shadow-md rounded-lg overflow-hidden mb-5 p-5 border border-gray-200 bg-white">
        <h2 class="text-xl font-bold pb-2">Tambah Prodi</h2>
        <form action="{{ route('prodi.store') }}" method="POST" class="flex flex-col items-center">
            @csrf
            <div class="mb-4 w-full max-w-lg">
                <label for="nama_prodi" class="block font-bold text-[#295F98] mb-2">Nama Prodi</label>
                <input type="text" name="nama_prodi" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
            </div>

            <div class="mb-4 w-full max-w-lg">
                <label for="jurusan_id" class="block font-bold text-[#295F98] mb-2">Pilih Jurusan</label>
                <select name="jurusan_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                    @foreach($jurusans as $jurusan)
                    <option value="{{ $jurusan->id_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1 mt-4">Simpan</button>
        </form>
    </div>

    <div class="relative shadow-md rounded-lg overflow-hidden p-5 border border-gray-200 bg-white w-full">
        <h2 class="text-xl font-bold pb-2">Tabel Jurusan ({{ $jurusans->count()}} Data)</h2>

        <div class="w-full overflow-x-auto">
            <table class="w-full text-left table-auto">
                <thead>
                    <tr class="text-[#344767]">
                        <th class="px-4 py-2 border-b">Jurusan</th>
                        <th class="px-4 py-2 border-b">Aksi</th>
                    </tr>
            </thead>
            <tbody>
                @foreach($jurusans as $jurusan)
                <tr class="text-[#295F98] font-bold">
                    <td class="px-4 py-2 border-b">{{ $jurusan->nama_jurusan }}</td>
                    <td class="px-4 py-2 border-b">
                        <form action="{{ route('jurusan.destroy', $jurusan->id_jurusan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-5 py-1 bg-gradient-to-r from-[#E11818] to-[#FF7171] text-white font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="relative shadow-md rounded-lg overflow-hidden p-5 border border-gray-200 bg-white w-full mb-5">
        <h2 class="text-xl font-bold pb-2">Data Prodi ({{ $prodis->count() }} Data)</h2>

        <div class="w-full overflow-x-auto">
            <table class="w-full text-left table-auto">
                <thead>
                    <tr class="text-[#344767]">
                        <th class="px-4 py-2 border-b">Prodi</th>
                        <th class="px-4 py-2 border-b">Jurusan</th>
                        <th class="px-4 py-2 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prodis as $prodi)
                    <tr class="text-[#295F98] font-bold">
                        <td class="px-4 py-2 border-b">{{ $prodi->nama_prodi }}</td>
                        <td class="px-4 py-2 border-b">{{ $prodi->jurusan->nama_jurusan }}</td>
                        <td class="px-4 py-2 border-b">
                            <form action="{{ route('prodi.destroy', $prodi->id_prodi) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-5 py-1 bg-gradient-to-r from-[#E11818] to-[#FF7171] text-white font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
