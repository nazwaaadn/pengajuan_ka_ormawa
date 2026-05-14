@extends('components.main')
@include('layouts.head')
@include('components.navbar2')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="w-full px-4 py-6 mx-auto" id="content">
        <!-- Kotak informasi ormawa belum disetujui dan pengajuan -->
        {{-- <div class="flex flex-col sm:flex-row sm:space-x-6 mb-6"> --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Kotak biru dengan gradasi (ormawa yang belum disetujui) -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-6 px-4 rounded-lg shadow-lg flex flex-col h-48">
                <h2 class="text-sm sm:text-2xl font-bold text-white mb-3 ml-4 mt-1/3">Pengajuan Yang Belum Diterima</h2>
                <h2 class="text-sm sm:text-2xl font-bold text-white mb-3 ml-4 mt-1/3">Periode {{ $periodeAktif }}</h2>
                <h2 class="text-4xl sm:text-5xl font-bold text-white mb-3 ml-4 mt-1/3">{{ $totalOrmawaBelumMengajukan }} Pengajuan</h2>
                <!-- Button untuk membuka modal -->
                <button onclick="openPopup()"
                    class="mt-4 bg-white text-blue-700 px-4 py-1.5 rounded-lg font-semibold shadow-lg border border-blue-700 hover:bg-blue-700 hover:text-white transition duration-300">
                    Lihat Detail
                </button>
            </div>

            <!-- Kotak oranye (judul sistem informasi) dengan gambar latar -->
            <div class="md:col-span-2 relative bg-orange-500 rounded-lg shadow-lg overflow-hidden h-48">
                <img src="{{ asset('assets/img/polban.jpg') }}" alt="Gedung Polban" class="absolute inset-0 w-full h-full object-cover opacity-50">
                <div class="relative z-10 p-4 flex items-center justify-center h-full">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white text-center">Pengajuan Ketua ORMAWA</h2>
                </div>
            </div>
        </div>

        <!-- disini buat timeline alqan -->
        <!-- Area Kosong untuk Timeline -->
        <div class="mx-auto my-auto pt-16">
            <div class="flex justify-center">
                <ol class="items-center sm:flex">
                    @foreach ($timelines as $timeline)
                        <li class="relative mb-6 pr-3 pl-3" style="margin-center: 20px;">
                            <div class="flex justify-center">
                                <div class="z-10 flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full ring-0 ring-white shrink-0">
                                    <svg class="w-5.5 h-5.5 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <h2 class="text-base font-semibold text-gray-900">{{ $timeline->judul_timeline }}</h2>
                                <time class="block mb-2 text-sm font-normal leading-none text-gray-400">
                                    {{ $timeline->tanggal_timeline_awal }} - {{ $timeline->tanggal_timeline_akhir }}
                                </time>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>

        <div class="flex items-center justify-center min-h-screen ">
            <div class="mb-10 w-1/2 border-black border-solid border-2">
                <h3 class="text-center text-2xl font-bold text-[#344767] py-2">Persyaratan Data Pengajuan</h3>
                @if(file_exists(storage_path('app/PDF/Persyaratan/' . date('Y') . '_PersyaratanPengajuan.pdf')))
                    <iframe class="mx-auto w-full p-5" src="{{ route('file.show', ['id' => 'Persyaratan', 'filename' => date('Y') . '_PersyaratanPengajuan.pdf']) }}" width="50%" height="600px"></iframe>
                @else
                    <p class="text-red-500 text-center text-xl">*Persyaratan tidak tersedia, hubungi pihak kemahasiswaan!!</p>
                @endif
            </div>
        </div>

        <!-- Tombol Lakukan Pengajuan -->
        <div class="flex my-auto mx-auto ">
            <a href="{{ route('form') }}" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold text-center py-3 rounded-lg block h-18">
                1. Lakukan Pengajuan
            </a>
        </div>
        <div class="flex my-auto mx-auto py-5 w-full">
            @if ($exists && $pengajuan->status === \App\Enums\PengajuanStatus::Diterima)
                <button
                    class="btn-upload-surat w-full bg-[#FFC107] hover:bg-[#5d4f25] text-white font-semibold text-center py-3 rounded-lg block h-18"
                    data-edit-url="{{ route('surat.upload', ['nim' => $pengajuan->nim, 'id' => $pengajuan->id]) }}">
                    2. Upload Surat Pernyataan, Surat Perjanjian, dan Surat MOU
                </button>
            @else
                <button
                    class="alert-btn-upload-surat w-full bg-[#FFC107] hover:bg-[#5d4f25] text-white font-semibold text-center py-3 rounded-lg block h-18">
                    2. Upload Surat Pernyataan, Surat Perjanjian, Surat MoU, dan Surat KAK
                </button>
            @endif
        </div>

    </div>

    {{-- <script>
        function openPopup() {
            let ormawaList = '<ul style="list-style-type: none; padding-left: 0; text-align: left;">';
            let index = 1;
            @foreach($allOrmawaBelumDisetujui as $ormawa)
                ormawaList += '<li style="margin-left: 20px;">' + index + '. {{ $ormawa->nama_ketua ?? $ormawa->ketua_ormawa }}</li>';
                index++;
            @endforeach
            ormawaList += '</ul>';

            Swal.fire({
                title: 'Berikut merupakan Ormawa yang pengajuannya belum diterima.',
                html: ormawaList || 'Tidak ada Ormawa yang perlu disetujui.',
                icon: 'warning',
                confirmButtonText: 'Tutup'
            });
        }
    </script> --}}

    <script>
        function openPopup() {
            let ormawaList = '<ul style="list-style-type: none; padding-left: 0; text-align: left;">';
            let index = 1;

            @foreach($allOrmawaBelumDisetujui as $ormawa)
                ormawaList += '<li>' + index + '. {{ $ormawa->nama_ketua ?? $ormawa->ketua_ormawa }}</li>';
                index++;
            @endforeach

            ormawaList += '</ul>';

            Swal.fire({
                title: 'Berikut merupakan Ormawa yang belum melakukan pengajuan.',
                html: ormawaList || '<p>Tidak ada Ormawa yang belum melakukan pengajuan.</p>',
                icon: 'info',
                confirmButtonText: 'Tutup'
            });
        }
    </script>



    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Upload Surat Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @endif

    <script>
        document.querySelectorAll('.btn-upload-surat').forEach(button => {
            button.addEventListener('click', function () {
                const editUrl = this.getAttribute('data-edit-url');

                Swal.fire({
                    title: `Sudah Mengunduh Surat Yang Ada Pada Progres Tabel?`,
                    text: `Jika Sudah, Lakukan Upload Surat`,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Tutup',
                    cancelButtonText: 'Upload Surat',
                    reverseButtons: true
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = editUrl;
                    }
                });
            });
        });
    </script>

    <script>
        document.querySelectorAll('.alert-btn-upload-surat').forEach(button => {
            button.addEventListener('click', function () {
                Swal.fire({
                    title: `Selesaikan Proses Pengajuan Terlebih Dahulu !`,
                    text: `Anda Bisa Kembali Lagi Setelahnya.`,
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    reverseButtons: true
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = editUrl;
                    }
                });
            });
        });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('upload-btn')) {
            event.preventDefault();
            Swal.fire({
                title: 'Upload SK',
                html: `
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="surat_pernyataan">Surat Pernyataan Pengajuan</label>
                                <input id="surat_pernyataan" class="block w-full text-sm bg-white border rounded p-2" type="file" name="surat_pernyataan" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="surat_perjanjian">Surat Perjanjian</label>
                                <input id="surat_perjanjian" class="block w-full text-sm bg-white border rounded p-2" type="file" name="surat_perjanjian" required>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="surat_mou">Surat MOU</label>
                                <input id="surat_mou" class="block w-full text-sm bg-white border rounded p-2" type="file" name="surat_mou" required>
                            </div>
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Upload',
                preConfirm: () => {
                    const form = document.getElementById('uploadForm');
                    if (!form) {
                        Swal.showValidationMessage('Form tidak ditemukan.');
                        return false;
                    }

                    const formData = new FormData(form);
                    formData.append('_method', 'PUT'); // Method spoofing

                    if (
                        !formData.get('surat_pernyataan')?.name ||
                        !formData.get('surat_perjanjian')?.name ||
                        !formData.get('surat_mou')?.name
                    ) {
                        Swal.showValidationMessage('Harap unggah semua file yang diminta!');
                        return false;
                    }

                    return formData;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = result.value;

                    const uploadUrl = "{{ $uploadUrl }}"; // URL yang sudah di-generate dari Blade
                        fetch(uploadUrl, {
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal mengunggah file.');
                            return response.json();
                        })
                        .then(data => {
                            Swal.fire('Berhasil!', 'File berhasil diunggah.', 'success');
                        })
                        .catch(error => {
                            Swal.fire('Error!', `Gagal mengunggah file: ${error.message}`, 'error');
                        });
                }
            });
        }
    });
});
    </script> --}}

    {{-- <!-- Modal Popup -->
    <div id="popup" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg w-1/2 max-h-[80vh] overflow-y-auto">
            <h3 class="text-xl font-bold mb-4">Pengajuan Belum Disetujui</h3>
            <ul>
                <!-- Menampilkan Ormawa yang pengajuannya belum disetujui atau belum mengajukan -->
                @foreach($allOrmawaBelumDisetujui as $ormawa)
                    <li class="mb-2">{{ $ormawa->nama_ketua ?? $ormawa->ketua_ormawa }}</li> <!-- Menampilkan nama Ormawa -->
                @endforeach
            </ul>
            <button onclick="closePopup()" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg">Tutup</button>
        </div>
    </div>

    <script>
        // Fungsi untuk membuka pop-up
        function openPopup() {
            document.getElementById('popup').classList.remove('hidden');
        }

        // Fungsi untuk menutup pop-up
        function closePopup() {
            document.getElementById('popup').classList.add('hidden');
        }
    </script> --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
