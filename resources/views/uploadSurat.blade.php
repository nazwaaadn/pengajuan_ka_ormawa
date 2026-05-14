@extends('components.main')
@include('layouts.head')
@include('components.navbar2')

@section('content')
    <div class="w-full px-4 py-6 mx-auto" id="content">

        <!-- Konten Upload Berkas -->
        <form action="{{ route('surat.update', ['id' => $pengajuan->id, 'nim' => $pengajuan->nim]) }}" method="POST" enctype="multipart/form-data" id="applicationForm">
            @csrf
            @method('PUT') <!-- Method spoofing for PUT -->

            <div class="container mx-auto mt-10 flex-1">
                <h2 class="text-3xl font-bold text-blue-800 dark:text-white text-center">Upload Surat</h2>
                <p class="mb-14 font-bold text-blue-800 dark:text-white text-center">Upload Surat dapat dilakukan satu persatu.</p>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-8">
                    <div class="mb-4">
                        @if ($pengajuan->berkas && $pengajuan->berkas->surat_pernyataan === 'pengaju belum mengirimkan file ini')
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_perjanjian">Surat Penyataan Pengajuan<label class="block text-sm text-red-600">*Anda Belum Upload Surat Ini !</label></label>
                        @else
                        <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_perjanjian">Surat Penyataan Pengajuan<label class="block text-sm text-green-400">*Anda Sudah Upload Surat Ini !</label></label>
                        @endif
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_pernyataan" type="file" name="surat_pernyataan" required>
                        @error('surat_pernyataan')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        @if ($pengajuan->berkas && $pengajuan->berkas->surat_perjanjian === 'pengaju belum mengirimkan file ini')
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_perjanjian">Surat Perjanjian<label class="block text-sm text-red-600">*Anda Belum Upload Surat Ini !</label></label>
                        @else
                        <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_perjanjian">Surat Perjanjian<label class="block text-sm text-green-400">*Anda Sudah Upload Surat Ini !</label></label>
                        @endif
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_perjanjian" type="file" name="surat_perjanjian" required>
                        @error('surat_perjanjian')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-8 mt-7">
                    <div class="mb-4">
                        @if ($pengajuan->berkas && $pengajuan->berkas->surat_mou === 'pengaju belum mengirimkan file ini')
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_perjanjian">Surat MOU<label class="block text-sm text-red-600">*Anda Belum Upload Surat Ini !</label></label>
                        @else
                        <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_perjanjian">Surat MOU<label class="block text-sm text-green-400">*Anda Sudah Upload Surat Ini !</label></label>
                        @endif
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_mou" type="file" name="surat_mou" required>
                            @php
                                $filePath = storage_path('app/PDF/Template_Surat_MOU/' . date('Y') . '_TemplateSuratMOU.pdf')
                            
                            @endphp
                        @if ($pengajuan->status === \App\Enums\PengajuanStatus::Diterima && file_exists($filePath))
                            <div class="mt-2 text-sm">
                                <label class="text-sm text-red-600">*Khusus untuk surat MOU bisa diunduh disini, </label>
                                <button
                                    data-file="{{ route('file.show', ['id' => 'Template_Surat_MOU', 'filename' => date('Y') . '_TemplateSuratMOU.pdf']) }}"
                                    class="preview-btn text-blue-600 underline underline-offset-4">
                                    Download Surat MOU
                                </button>
                            </div>
                        @else
                            <p class="text-sm text-red-600">*Hubungi Pihak Kemahasiswaan Untuk Template MOU</p>
                        @endif
                        @error('surat_mou')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        @if ($pengajuan->berkas && $pengajuan->berkas->surat_kak === 'pengaju belum mengirimkan file ini')
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_kak">Surat KAK<label class="block text-sm text-red-600">*Anda Belum Upload Surat Ini !</label></label>
                        @else
                        <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_kak">Surat KAK<label class="block text-sm text-green-400">*Anda Sudah Upload Surat Ini !</label></label>
                        @endif
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_kak" type="file" name="surat_kak" required>
                        @error('surat_kak')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-4">
            <button type="button" id="submitBtn" class="w-full h-11 bg-gradient-to-r from-[#00008B] to-[#3B3BBD] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1">Send</button>
        </div>
    </div>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            // Ambil elemen input file
            const suratPernyataan = document.getElementById('surat_pernyataan');
            const suratPerjanjian = document.getElementById('surat_perjanjian');
            const suratMOU = document.getElementById('surat_mou');
            const suratKAK = document.getElementById('surat_kak');

            // Cek apakah ada setidaknya satu file yang diunggah
            if (!suratPernyataan.files.length && !suratPerjanjian.files.length && !suratMOU.files.length && !suratKAK.files.length) {
                Swal.fire({
                    title: 'File Tidak Ditemukan!',
                    text: 'Harap unggah setidaknya satu file sebelum mengirimkan!',
                    icon: 'error',
                    confirmButtonText: 'OK',
                });
                return; // Hentikan proses jika tidak ada file
            }
            Swal.fire({
                title: 'Yakin data sudah benar?',
                text: "Pastikan semua data telah diisi dengan benar sebelum mengirimkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Cek Lagi',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form jika user yakin
                    document.getElementById('applicationForm').submit();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('preview-btn')) {
                event.preventDefault();

                const fileUrl = event.target.getAttribute('data-file');
                Swal.fire({
                    title: 'Surat MOU',
                    html: `
                        <div style="height: 500px; overflow: auto;">
                            <iframe src="${fileUrl}" width="100%" height="500px"></iframe>
                        </div>
                    `,
                    showCancelButton: false,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    width: '60%',
                    animation: false
                });
            }
        });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
