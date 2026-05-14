@extends('components.main')
@include('layouts.head')
@include('components.navbar2staff')

@section('content')
<div class="w-full px-4 py-6 mx-auto min-h-screen" id="content">
    <div class="w-full">
        <!-- Form Tambah Users -->
        <div class="relative shadow-md rounded-lg overflow-hidden mb-5 p-5 border border-gray-200 bg-white">
            <h2 class="text-xl font-bold pb-2">Tambah User</h2>
            <form action="{{ route('users.store') }}" method="POST" class="flex flex-col items-center">
                @csrf
                <div class="mb-4 w-full max-w-lg">
                    <label for="name" class="block font-bold text-[#295F98] mb-2">Nama User</label>
                    <input type="text" name="name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('name')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                <div class="mb-4 w-full max-w-lg">
                    <label for="email" class="block font-bold text-[#295F98] mb-2">Email User</label>
                    <input type="text" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('email')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                </div>
                <div class="mb-4 w-full max-w-lg">
                    <label for="password" class="block font-bold text-[#295F98] mb-2">Password User</label>
                    <input type="text" name="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @error('password')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                </div>
                <div class="mb-4 w-full max-w-lg">
                    <label for="role_id" class="block font-bold text-[#295F98] mb-2">Pilih Role User</label>
                    <select name="role_id" id="role_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option value="" disabled selected>Pilih Role User Sebagai Apa</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="staff_kemahasiswaan">Staff Kemahasiswaan</option>
                    </select>
                </div>
                <button type="submit" class="bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1 mt-4">Simpan</button>
            </form>
        </div>

        <!-- Tabel Daftar Ketua Ormawa -->
        <div class="relative shadow-md rounded-lg overflow-hidden p-5 border border-gray-200 bg-white w-full">
            <h2 class="text-xl font-bold pb-2">Daftar User ({{ $user->count()}} User)</h2>

            <div class="w-full overflow-x-auto">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="text-[#344767]">
                            <th class="px-4 py-2 border-b">User ID</th>
                            <th class="px-4 py-2 border-b">Nama</th>
                            <th class="px-4 py-2 border-b">Email</th>
                            <th class="px-4 py-2 border-b">Role</th>
                            <th class="px-4 py-2 border-b">Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $user)
                        <tr class="text-[#295F98] font-bold">
                            <td class="px-4 py-2 border-b">{{ $user->id }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->name }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->email }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->role_id }}</td>
                            <td class="px-4 py-2 border-b">{{ $user->password }}</td>
                            <td class="px-4 py-2 border-b">
                                <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
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