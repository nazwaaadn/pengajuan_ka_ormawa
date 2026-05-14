@extends('components.main')
@include('layouts.head')
@include('components.navbar2')

@section('content')
    <div class="w-full px-4 py-6 mx-auto" id="content">

        <div class="bg-red-400 shadow-lg rounded-lg p-6 my-8">
            <h3 class="text-2xl font-bold text-center text-black mb-5">Pesan Revisi</h3>
            <p>{{ $pengajuan->keterangan }}</p>
        </div>

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
        <form action="{{ route('berkas.update', ['id' => $pengajuan->id, 'nim' => $pengajuan->nim]) }}" method="POST" enctype="multipart/form-data" id="applicationForm">
            @csrf
            @method('PUT') <!-- Method spoofing for PUT -->

            {{-- <div class="container mx-auto mt-10 flex-1"> --}}
            <div class="container mx-auto mt-10">
                <div class="block mb-7 text-sm font-extrabold ">
                    <p class="text-red-600 font-bold text-lg">*Pastikan Berkas Yang Diupload Berbentuk PDF.</p>
                    <p class="text-red-600 font-bold text-lg">*Pastikan Ukuran Berkas Kurang dari 2MB.</p>
                </div>
                {{-- <div class="grid grid-cols-2 gap-8"> --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">

                <!-- Kolom Pertama (8 tempat upload file) -->
                <div>
                    <!-- Tempat upload file 1 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="scan_ktp">Scan KTP, 
                            @error('scan_ktp')
                                <label class="text-red-600">{{ $message }}</label>
                            @enderror
                        </label>
                        
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="scan_ktp" type="file" name="scan_ktp">
                        <!-- Tampilkan file yang sudah diupload -->
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_scan_ktp.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                    data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_scan_ktp.pdf']) }}"
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4 ">
                                    Lihat file Scan KTP sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 2 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="surat_sehat">Surat Sehat
                            @error('surat_sehat')
                                <label class="text-red-600">{{ $message }}</label>
                            @enderror
                        </label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_sehat" type="file" name="surat_sehat">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_surat_sehat.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                    data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_surat_sehat.pdf']) }}"
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Surat Sehat sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 3 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="surat_rekomendasi_jurusan">Surat Rekomendasi Jurusan
                        @error('surat_rekomendasi_jurusan')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_rekomendasi_jurusan" type="file" name="surat_rekomendasi_jurusan">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_surat_rekomendasi_jurusan.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                    data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_surat_rekomendasi_jurusan.pdf']) }}"    
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Surat Rekomendasi Jurusan sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 4 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="transkip_rekomendasi_jurusan">Transkip Akademik Semester Terakhir (IPK)
                        @error('transkip_rekomendasi_jurusan')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="transkip_rekomendasi_jurusan" type="file" name="transkip_rekomendasi_jurusan">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_transkip_rekomendasi_jurusan.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                    data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_transkip_rekomendasi_jurusan.pdf']) }}"    
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Transkip Akademik Semester Terakhir sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 5 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="sertifikat_lkmm">Sertifikat LKMM
                        @error('sertifikat_lkmm')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_lkmm" type="file" name="sertifikat_lkmm">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_sertifikat_lkmm.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                    data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_sertifikat_lkmm.pdf']) }}"  
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Sertifikat LKMM sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 6 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="sertifikat_pelatihan_kepemimpinan">Sertifikat Pelatihan Kepemimpinan
                        @error('sertifikat_pelatihan_kepemimpinan')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_pelatihan_kepemimpinan" type="file" name="sertifikat_pelatihan_kepemimpinan">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_sertifikat_pelatihan_kepemimpinan.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_kepemimpinan.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Sertifikat Pelatihan Kepemimpinan sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 7 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="sertifikat_pelatihan_emosional_spiritual">Sertifikat Pelatihan Emosional Spiritual bagi Mahasiswa
                        @error('sertifikat_pelatihan_emosional_spiritual')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_pelatihan_emosional_spiritual" type="file" name="sertifikat_pelatihan_emosional_spiritual">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_sertifikat_pelatihan_emosional_spiritual.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_sertifikat_pelatihan_emosional_spiritual.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Sertifikat Pelatihan Emosional Spiritual sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 8 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="sertifikat_bahasa_asing">Sertifikat Bahasa Asing (EPT)
                        @error('sertifikat_bahasa_asing')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_bahasa_asing" type="file" name="sertifikat_bahasa_asing">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_sertifikat_bahasa_asing.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_sertifikat_bahasa_asing.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Sertifikat Bahasa Asing sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Kolom Kedua (8 tempat upload file) -->
                <div>
                    <!-- Tempat upload file 9 -->
                     <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="scan_ktm">Scan KTM
                            @error('scan_ktm')
                                <label class="text-red-600">{{ $message }}</label>
                            @enderror
                        </label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="scan_ktm" type="file" name="scan_ktm">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_scan_ktm.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_scan_ktm.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Scan KTM sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 10 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-extrabold text-[#295F98]" for="surat_keterangan_berkelakuan_baik">Surat Keterangan Berkelakuan Baik
                        @error('surat_keterangan_berkelakuan_baik')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_keterangan_berkelakuan_baik" type="file" name="surat_keterangan_berkelakuan_baik">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_surat_keterangan_berkelakuan_baik.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_surat_keterangan_berkelakuan_baik.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Surat Keterangan Berkelakuan Baik sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 11 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="surat_penyataan_mandiri">Surat Pernyataan Mandiri
                        @error('surat_penyataan_mandiri')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="surat_penyataan_mandiri" type="file" name="surat_penyataan_mandiri">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_surat_penyataan_mandiri.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_surat_penyataan_mandiri.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Surat Pernyataan Mandiri sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 12 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="sertifikat_pkkmb">Sertifikat PKKMB
                        @error('sertifikat_pkkmb')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_pkkmb" type="file" name="sertifikat_pkkmb">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_sertifikat_pkkmb.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_sertifikat_pkkmb.pdf']) }}"      
                                data-file="{{ asset('storage/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '.pdf') }}"
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Sertifikat PKKMB sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 13 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="sertifikat_bela_negara">Sertifikat Bela Negara
                        @error('sertifikat_bela_negara')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_bela_negara" type="file" name="sertifikat_bela_negara">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_sertifikat_bela_negara.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_sertifikat_bela_negara.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Sertifikat Bela Negara sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 14 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="sertifikat_agent_of_change">Sertifikat Agent of Change
                        @error('sertifikat_agent_of_change')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_agent_of_change" type="file" name="sertifikat_agent_of_change">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_sertifikat_agent_of_change.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_sertifikat_agent_of_change.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Sertifikat Agent of Change sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 15 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="sertifikat_berorganisasi">Sertifikat Berorganisasi (Minimal sebagai koordinator)
                        @error('sertifikat_berorganisasi')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="sertifikat_berorganisasi" type="file" name="sertifikat_berorganisasi">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_sertifikat_berorganisasi.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_sertifikat_berorganisasi.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Sertifikat Berorganisasi sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    <!-- Tempat upload file 16 -->
                    <div class="mb-4">
                        <label class="block mb-2 text-sm sm:text-xs font-extrabold text-[#295F98]" for="berita_acara_pemilihan">Berita Acara Pemilihan
                        @error('berita_acara_pemilihan')
                            <label class="text-red-600">{{ $message }}</label>
                        @enderror</label>
                        <input class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light transition duration-200 ease-in-out hover:-translate-y-1" id="berita_acara_pemilihan" type="file" name="berita_acara_pemilihan">
                        @if(file_exists(storage_path('app/PDF/' . $pengajuan->id . '/' . 'Pengaju_'. $pengajuan->id . '_berita_acara_pemilihan.pdf')))
                            <div class="mt-2 text-sm">
                                <button
                                data-file="{{ route('file.show', ['id' => $pengajuan->id, 'filename' => 'Pengaju_' . $pengajuan->id . '_berita_acara_pemilihan.pdf']) }}"      
                                    class="preview-btn text-blue-600 text-sm underline underline-offset-4">
                                    Lihat file Berita Acara Pemilihan sebelumnya
                                </button>
                            </div>
                        @endif
                    </div>
                    @error('pdf')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Tombol Previous dan Next -->
        <div class="flex justify-between mt-4">
            <button type="button" class="bg-gradient-to-r from-[#00008B] to-[#3B3BBD] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1"><a href="{{ route('pengajuan.edit', ['nim' => $pengajuan->nim, 'id' => $pengajuan->id]) }}" >Previous</a></button>
            <button type="button" id="submitBtn" class="bg-gradient-to-r from-[#00008B] to-[#3B3BBD] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1">Send</button>
        </div>
    </div>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
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
        document.querySelectorAll('.preview-btn').forEach(button => {
            button.replaceWith(button.cloneNode(true));
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('preview-btn')) {
                event.preventDefault();

                const fileUrl = event.target.getAttribute('data-file');
                Swal.fire({
                    title: 'Preview PDF',
                    html: `
                        <div style="height: 500px; overflow: auto;">
                            <iframe src="${fileUrl}" width="100%" height="500px"></iframe>
                        </div>
                    `,
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Kembali',
                    width: '60%',
                    animation: false
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
