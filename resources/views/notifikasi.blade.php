@include('layouts.head')
<head>
    <title>Pengajuan Ketua ORMAWA</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

@extends('components.main')

    @if (Auth::user() && Auth::user()->role_id === 'staff_kemahasiswaan')
        @include('components.navbar2staff')
    @elseif (Auth::user() && Auth::user()->role_id === 'mahasiswa')
        @include('components.navbar2')
    @endif
{{-- @include('components.navbar2') --}}

@section('content')
<div class="w-full px-4 py-6 mx-auto" id="content">
    <h1 class="text-2xl font-bold mb-4 text-black-600">Notifikasi</h1>

    <div class="flex flex-col lg:flex-row h-screen">
        <!-- Sidebar Notifikasi -->
        <div class="lg:w-1/3 p-6 overflow-y-auto">
            <ul class="list-none space-y-4">
                @foreach ($notifications as $notification)
                    @php
                        $userRole = auth()->user()->role_id;
                        $isTarget = $notification->notifiable_id == auth()->user()->id && $notification->data['role_target'] == $userRole;
                    @endphp

                    @if ($isTarget)
                    <li class="notification-item cursor-pointer p-4 bg-white shadow-lg rounded-lg hover:bg-gray-200 transition"
                        data-id="{{ $notification->id }}" onclick="showNotification({{ json_encode($notification) }})">
                        <h2 class="text-lg font-medium text-gray-800">
                            {{ $notification->data['nama'] ?? 'Nama tidak tersedia' }}
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ Str::limit($notification->data['message'] ?? 'Tidak ada pesan.', 100) }}
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            {{ \Carbon\Carbon::parse($notification->created_at)->timezone('Asia/Jakarta')->locale('id-ID')->isoFormat('dddd, D MMMM YYYY, HH:mm') }}
                        </p>
                        <div class="mt-2">
                            @if ($notification->is_read)
                                <span class="text-sm px-3 py-1 bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white rounded-lg font-semibold shadow-md">✓ Sudah Dibaca</span>
                            @else
                                <span class="text-sm px-3 py-1 text-white bg-gradient-to-r from-[#6C7F9E] to-[#A3B3D3] rounded-lg font-semibold shadow-md">● Belum Dibaca</span>
                            @endif
                        </div>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Live View Card -->
        <div id="live-card" class="lg:w-2/3 p-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <!-- Placeholder -->
                <div id="notification-placeholder" class="text-center text-gray-500">
                    <i class="fas fa-bell text-4xl mb-4"></i>
                    <p>Pilih notifikasi untuk melihat detail</p>
                </div>
                <!-- Content -->
                <div id="notification-content" class="hidden">
                    <h2 id="live-title" class="text-xl font-bold text-gray-800">Judul Notifikasi</h2>
                    <p id="live-message" class="text-gray-600 mt-4">Detail notifikasi akan tampil di sini.</p>
                    <p id="live-date" class="text-xs text-gray-400 mt-4">Tanggal dan waktu.</p>

                    <!-- Status sudah dibaca -->
                    <span id="live-read-status" class="text-sm px-3 py-1 bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white rounded-lg font-semibold shadow-md hidden">✓ Sudah Dibaca</span>

                    <!-- Form untuk tandai sebagai sudah dibaca -->
                    <form id="mark-as-read-form" action="" method="POST" class="hidden">
                        @csrf
                        <button type="submit" class="text-sm px-3 py-1 text-white bg-gradient-to-r from-[#FF7F00] to-[#FF9A36] rounded-lg font-semibold shadow-md">Tandai Telah Dibaca</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showNotification(notification) {
        // Update content
        document.getElementById('live-title').textContent = notification.data.nama || 'Nama tidak tersedia';
        document.getElementById('live-message').textContent = notification.data.message || 'Tidak ada pesan.';
        // document.getElementById('live-date').textContent = new Date(notification.created_at).toLocaleString();

        const readStatus = notification.is_read;
        const liveReadStatus = document.getElementById('live-read-status');
        const markAsReadForm = document.getElementById('mark-as-read-form');

        if (readStatus) {
            liveReadStatus.classList.remove('hidden');
            markAsReadForm.classList.add('hidden');
        } else {
            liveReadStatus.classList.add('hidden');
            markAsReadForm.classList.remove('hidden');
            markAsReadForm.action = `/markAsRead/${notification.id}`;
        }

        // Show live card content
        document.getElementById('notification-placeholder').classList.add('hidden');
        document.getElementById('notification-content').classList.remove('hidden');

        document.getElementById('live-date').textContent =
        new Date(notification.created_at).toLocaleString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            // hour: '2-digit',
            // minute: '2-digit'
        });

        // Tambahkan logika untuk mengatur warna abu-abu
        const notificationItems = document.querySelectorAll('.notification-item');
        notificationItems.forEach(item => item.classList.remove('selected-notification'));

        const selectedItem = document.querySelector(`[data-id="${notification.id}"]`);
        selectedItem.classList.add('selected-notification');
    }
</script>
@endsection
