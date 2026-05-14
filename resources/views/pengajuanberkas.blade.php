@extends('components.main')
@include('layouts.head')
@include('components.navbar2')

@section('content')
    <div class="w-full px-4 py-6 mx-auto" id="content">

        <!-- Stepper Container -->
        <div class="flex items-start max-w-4xl mx-auto">
            <!-- Step 1 (Completed or Active) -->
            <div id="step1" class="w-full">
                <div class="flex items-center w-full">
                    <div id="circle1" class="w-6 h-6 shrink-0 p-1 flex items-center justify-center rounded-full bg-gray-300">
                        <i class="fas fa-check text-white text-xs hidden"></i>
                    </div>
                    <div id="progressStep1" class="w-56 h-1 mx-2 rounded-lg bg-gray-300"></div>
                </div>
                <div class="mt-1">
                    <h6 class="text-sm font-bold text-gray-500" id="textStep1">Pengisian Form</h6>
                    <p class="text-xs text-gradient-orange" id="status1">Completed</p>
                </div>
            </div>

            <!-- Step 2 (Completed or Active) -->
            <div id="step2" class="w-full">
                <div class="flex items-center w-full">
                    <div id="circle2" class="w-6 h-6 shrink-0 p-1 flex items-center justify-center rounded-full bg-gray-300">
                        <i class="fas fa-check text-white text-xs hidden"></i>
                    </div>
                    <div class="w-56 h-1 mx-2 rounded-lg bg-gray-300" id="line2"></div>
                </div>
                <div class="mt-1">
                    <h6 class="text-sm font-bold text-gray-500" id="textStep2">Pengajuan Berkas</h6>
                    <p class="text-xs text-gray-500" id="status2">Pending</p>
                </div>
            </div>

            <!-- Step 3 (Pending) -->
            <div id="step3" class="w-full">
                <div class="flex items-center">
                    <div id="circle3" class="w-6 h-6 shrink-0 p-1 flex items-center justify-center rounded-full bg-gray-300">
                            <i class="fas fa-check text-white text-xs hidden"></i>
                    </div>
                    <span class="text-xs text-white font-bold" id="line3"></span>
                </div>
                <div class="mt-1">
                    <h6 class="text-sm font-bold text-gray-500" id="textStep3">Verifikasi Berkas</h6>
                    <p class="text-xs text-gray-500" id="status3">Pending</p>
                </div>
            </div>
        </div>
        <!-- End of Stepper Container -->

        <!-- Konten Upload Berkas -->
        <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data" id="applicationForm">
            @csrf
            {{-- <div class="container mx-auto mt-10 flex-1"> --}}
            <div class="container mx-auto mt-10">

                <div class="block mb-7 text-sm font-extrabold ">
                    <p class="text-red-600 text-lg">*Pastikan Berkas Yang Diupload Berbentuk PDF.</p>
                    <p class="text-red-600 text-lg">*Pastikan Ukuran Berkas Kurang dari 2MB.</p>
                </div>

                {{-- <div class="grid grid-cols-2 gap-8"> --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

                <!-- Kolom Pertama (8 tempat upload file) -->
                <div>
                    <!-- Tempat upload file 1 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="scan_ktp">Scan KTP (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="scan_ktp" type="file" name="scan_ktp" name="scan_ktp" required>
                            @error('scan_ktp')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 2 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_sehat">Surat Sehat (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_sehat" type="file" name="surat_sehat" required>
                            @error('surat_sehat')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 3 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_rekomendasi_jurusan">Surat Rekomendasi Jurusan (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_rekomendasi_jurusan" type="file" name="surat_rekomendasi_jurusan" required>
                            @error('surat_rekomendasi_jurusan')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 4 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="transkip_rekomendasi_jurusan">Transkip Akademik Semester Terakhir (IPK) [Maks 2MB]</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="transkip_rekomendasi_jurusan" type="file" name="transkip_rekomendasi_jurusan" required>
                            @error('transkip_rekomendasi_jurusan')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 5 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="sertifikat_lkmm">Sertifikat LKMM (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_lkmm" type="file" name="sertifikat_lkmm" required>
                            @error('sertifikat_lkmm')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 6 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="sertifikat_pelatihan_kepemimpinan">Sertifikat Pelatihan Kepemimpinan (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_pelatihan_kepemimpinan" type="file" name="sertifikat_pelatihan_kepemimpinan" required>
                            @error('sertifikat_pelatihan_kepemimpinan')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 7 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="sertifikat_pelatihan_emosional_spiritual">Sertifikat Pelatihan Emosional Spiritual bagi Mahasiswa (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_pelatihan_emosional_spiritual" type="file" name="sertifikat_pelatihan_emosional_spiritual" >
                            @error('sertifikat_pelatihan_emosional_spiritual')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 8 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="sertifikat_bahasa_asing">Sertifikat Bahasa Asing (EPT) [Maks 2MB]</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_bahasa_asing" type="file" name="sertifikat_bahasa_asing" required>
                            @error('sertifikat_bahasa_asing')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kedua (8 tempat upload file) -->
                    <div>
                        <!-- Tempat upload file 9 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="scan_ktm">Scan KTM (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="scan_ktm" type="file" name="scan_ktm" required>
                            @error('scan_ktm')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 10 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_keterangan_berkelakuan_baik">Surat Keterangan Berkelakuan Baik (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_keterangan_berkelakuan_baik" type="file" name="surat_keterangan_berkelakuan_baik" required>
                            @error('surat_keterangan_berkelakuan_baik')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 11 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_penyataan_mandiri">Surat Pernyataan Mandiri (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_penyataan_mandiri" type="file" name="surat_penyataan_mandiri" required>
                            @error('surat_penyataan_mandiri')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 12 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="sertifikat_pkkmb">Sertifikat PKKMB (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_pkkmb" type="file" name="sertifikat_pkkmb" required>
                            @error('sertifikat_pkkmb')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 13 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="sertifikat_bela_negara">Sertifikat Bela Negara (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_bela_negara" type="file" name="sertifikat_bela_negara" required>
                            @error('sertifikat_bela_negara')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 14 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="sertifikat_agent_of_change">Sertifikat Agent of Change (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_agent_of_change" type="file" name="sertifikat_agent_of_change" >
                            @error('sertifikat_agent_of_change')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 15 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="sertifikat_berorganisasi">Sertifikat Berorganisasi (Minimal sebagai koordinator) [Maks 2MB]</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_berorganisasi" type="file" name="sertifikat_berorganisasi" required>
                            @error('sertifikat_berorganisasi')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tempat upload file 16 -->
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="berita_acara_pemilihan">Berita Acara Pemilihan (Maks 2MB)</label>
                            <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="berita_acara_pemilihan" type="file" name="berita_acara_pemilihan" required>
                            @error('berita_acara_pemilihan')
                                <div class="text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        <!-- Tombol Previous dan Next -->
        <div class="flex justify-between mt-4">
            <button type="button" class="bg-gradient-to-r from-[#00008B] to-[#3B3BBD] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1"><a href="/form" >Previous</a></button>
            <button type="button" id="submitBtn" class="bg-gradient-to-r from-[#00008B] to-[#3B3BBD] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1">Send</button>
        </div>
    </div>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            // Ambil elemen form
            const form = document.getElementById('applicationForm');

            // Periksa validasi form
            if (!form.checkValidity()) {
                // Jika form tidak valid, tampilkan pesan validasi default browser
                form.reportValidity();
            } else {
                // Jika form valid, tampilkan SweetAlert
                Swal.fire({
                    title: 'Yakin data sudah benar?',
                    text: "Pastikan semua data telah terisi dengan benar sebelum mengirimkan! Perhatikan ukuran maksimal setiap filenya",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Kirim!',
                    cancelButtonText: 'Cek Lagi',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form jika user yakin
                        form.submit();
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const status = @json(session('status', 'pengajuan'));

            // Debug: Cek nilai status
            console.log("Status:", status);

            function updateProgressBar(step) {
                // Reset semua ke status awal
                const steps = ["circle1", "circle2", "circle3"];
                const lines = ["progressStep1", "line3"];
                const statuses = ["status1", "status2", "status3"];
                const texts = ["textStep1", "textStep2", "textStep3"]
                steps.forEach(id => document.getElementById(id).classList.replace("bg-gradient-orange", "bg-gray-300"));
                lines.forEach(id => document.getElementById(id)?.classList.replace("bg-gradient-orange", "bg-gray-300"));
                statuses.forEach(id => document.getElementById(id).classList.replace("text-gradient-orange", "text-gray-500"));
                texts.forEach(id => document.getElementById(id).classList.replace("text-gradient-orange", "text-gray-500"));

                // document.getElementById("status1").textContent = "Pending";
                // document.getElementById("status2").textContent = "Pending";
                // document.getElementById("status3").textContent = "Pending";

                // Update status sesuai step
                if (step === 'pengisian') {
                    document.getElementById("circle1").classList.replace("bg-gray-300", "bg-gradient-orange");
                    document.getElementById("status1").textContent = "Completed";
                    document.getElementById("status1").classList.add("text-gradient-orange");
                    document.getElementById("textStep1").classList.add("text-gradient-orange");
                }
                if (step === 'pengajuan' || step === 'verifikasi') {
                    document.getElementById("circle1").classList.replace("bg-gray-300", "bg-gradient-orange");
                    document.getElementById("circle2").classList.replace("bg-gray-300", "bg-gradient-orange");
                    document.getElementById("status2").textContent = "Completed";
                    document.getElementById("status2").classList.add("text-gradient-orange");
                    document.getElementById("status1").classList.add("text-gradient-orange");
                    document.getElementById("textStep1").classList.add("text-gradient-orange");
                    document.getElementById("textStep2").classList.add("text-gradient-orange");
                    document.getElementById("progressStep1").classList.replace("bg-gray-300", "line-gradient-blue");
                }
                if (step === 'verifikasi') {
                    document.getElementById("circle3").classList.replace("bg-gray-300", "bg-gradient-orange");
                    document.getElementById("status3").textContent = "Completed";
                    document.getElementById("status3").classList.add("text-gradient-orange");
                    document.getElementById("line3").classList.replace("bg-gray-300", "line-gradient-blue");
                }
            }

            updateProgressBar(status);
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
