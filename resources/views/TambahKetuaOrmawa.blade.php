@extends('components.main')
@include('layouts.head')
@include('components.navbar2staff')

@section('content')
<div class="w-full px-4 py-6 mx-auto min-h-screen" id="content">
    <div class="w-full">
        <!-- Form Tambah Ketua Ormawa -->
        <div class="relative shadow-md rounded-lg overflow-hidden mb-5 p-5 border border-gray-200 bg-white">
            <h2 class="text-xl font-bold pb-2">Tambah Ketua Ormawa</h2>
            <form action="{{ route('ketuaOrmawa.store') }}" method="POST" class="flex flex-col items-center">
                @csrf
                <div class="mb-4 w-full max-w-lg">
                    <label for="nama_ketua" class="block font-bold text-[#295F98] mb-2">Nama Ormawa</label>
                    <input type="text" name="nama_ketua" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                </div>

                <div class="mb-4 w-full max-w-lg">
                    <label for="ormawa_id" class="block font-bold text-[#295F98] mb-2">Pilih Jenis Ormawa</label>
                    <select name="ormawa_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @foreach($ormawas as $ormawa)
                        <option value="{{ $ormawa->id_ormawa }}">{{ $ormawa->nama_ormawa }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1 mt-4">Simpan</button>
            </form>
        </div>

        <!-- Tabel Daftar Ketua Ormawa -->
        <div class="relative shadow-md rounded-lg overflow-hidden p-5 border border-gray-200 bg-white w-full">

            <h2 class="text-xl font-bold pb-2">Data Ormawa ({{ $ketuaOrmawas->count()}} Data)</h2>

            <div class="w-full overflow-x-auto">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="text-[#344767]">
                            <th class="px-4 py-2 border-b">Ormawa</th>
                            <th class="px-4 py-2 border-b">Jenis Ormawa</th>
                            <th class="px-4 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ketuaOrmawas as $ketua)
                        <tr class="text-[#295F98] font-bold">
                            <td class="px-4 py-2 border-b">{{ $ketua->nama_ketua }}</td>
                            <td class="px-4 py-2 border-b">{{ $ketua->ormawa->nama_ormawa }}</td>
                            <td class="px-4 py-2 border-b">
                                <form action="{{ route('ketuaOrmawa.destroy', $ketua->id_ketua_ormawa) }}" method="POST" style="display:inline;">
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
</div>
@endsection
