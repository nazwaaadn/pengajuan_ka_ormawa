@extends('components.main')
@include('layouts.head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@include('components.navbar2')

@section('content')
    <div class="w-full px-4 py-6 mx-auto" id="content">

        <section class="bg-blue">
            <div class="container my-4">
                <!-- Stepper Container -->
                <div class="sm:max-0 sm:static flex items-start max-w-4xl mx-auto">
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


                <section class="bg-blue">
                    <div class="py-8 px-4 mx-auto">
                        <h3 class="mb-4 text-xl font-bold text-blue-800 text-center">  </h2>
                        <form action="{{ route('form.simpanPengajuan') }}" method="post" enctype="multipart/form-data" id="applicationForm">
                            @csrf
                            <!-- Mengatur Grid Layout 2 kolom -->
                            <div class="row g-4">
                                <!-- Nama -->
                                <div class="col-12" >
                                    <label for="nama" class="block mb-2 text-sm font-medium text-blue-800">Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama', session('pengajuan')['nama'] ?? '') }}" required>
                                </div>

                            <!-- NIM -->
                            <div class="col-12" >
                                <label for="nim" class="block mb-2 text-sm font-medium text-blue-800 dark:text-white">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control" placeholder="NIM Lengkap" value="{{ old('nim', session('pengajuan')['nim'] ?? '') }}" required>
                                @error('nim')
                                    <div class="text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Jurusan -->
                            <div class="col-xl-12" >
                                <label for="jurusan" class="block mb-2 text-sm font-medium text-blue-800 dark:text-white">Pilih Jurusan:</label>
                                <select id="jurusan" name="jurusan" class="form-select" required>
                                    <option value="">--Pilih Jurusan--</option>
                                    @foreach($jurusans as $jurusan)
                                        <option value="{{ $jurusan->nama_jurusan }}"
                                            {{ old('jurusan', session('pengajuan')['jurusan'] ?? '') == $jurusan->nama_jurusan ? 'selected' : '' }}
                                            data-id="{{ $jurusan->id_jurusan }}">{{ $jurusan->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Prodi -->
                            <div class="col-xl-12">
                                <label for="prodi" class="block mb-2 text-sm font-medium text-blue-800 dark:text-white">Pilih Prodi:</label>
                                <select id="prodi" name="prodi" class="form-select" required>
                                    <option value="">--Pilih Prodi--</option>
                                    @foreach($prodis as $prodi)
                                        <option value="{{ $prodi->nama_prodi }}"
                                            {{ old('prodi', session('pengajuan')['prodi'] ?? '') == $prodi->nama_prodi ? 'selected' : '' }}
                                            data-id="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Periode -->
                            <div class="col-xl-12">
                                @php
                                    $year = date('Y');
                                    $month = date('n');

                                    $periodeAktif = $month >= 11
                                        ? "$year-" . ($year + 1)
                                        : ($year - 1) . "-$year";
                                @endphp
                                <label for="periode" class="block mb-2 text-sm font-medium text-blue-800 dark:text-white">Periode</label>
                                <select name="periode" id="periode" class="form-select" required>
                                    <option value="" disabled selected>Pilih Periode</option>
                                    <option value="{{ $periodeAktif }}"
                                        {{ old('periode', session('pengajuan')['periode'] ?? '') == $periodeAktif ? 'selected' : '' }}>
                                        {{ $periodeAktif }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-xl-12">
                                <label for="ormawa" class="block mb-2 text-sm font-medium text-blue-800 dark:text-white">Ormawa</label>
                                <select id="ormawa" name="ormawa" class="form-select" required>
                                    <option value="">--Pilih Ormawa--</option>
                                    @foreach($ormawas as $ormawa)
                                        <option value="{{ $ormawa->nama_ormawa }}"
                                            {{ old('ormawa', session('pengajuan')['ormawa'] ?? '') == $ormawa->nama_ormawa ? 'selected' : '' }}
                                            data-id="{{ $ormawa->id_ormawa }}">{{ $ormawa->nama_ormawa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Ketua_ormawa -->
                            <div class="col-xl-12">
                                <div class="col-xl-12">
                                    <label for="ketua_ormawa" class="block mb-2 text-sm font-medium text-blue-800 dark:text-white">Pilih ketua ormawa:</label>
                                    <select id="ketua_ormawa" name="ketua_ormawa" class="form-select" required> <!-- Ganti 'prodi' menjadi 'ketua_ormawa' -->
                                        <option value="">--Pilih Ketua Ormawa--</option>
                                        @foreach($ketuaOrmawas as $kt)
                                            <option value="{{ $kt->nama_ketua }}"
                                                {{ old('ketua_ormawa', session('pengajuan')['ketua_ormawa'] ?? '') == $kt->nama_ketua ? 'selected' : '' }}
                                                data-id="{{ $kt->id_ketua_ormawa }}">{{ $kt->nama_ketua }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                <!-- No. Telepon -->
                                <div class="col-sm-6">
                                    <label for="telp" class="block mb-2 text-sm font-medium text-blue-800">No.Telepon</label>
                                    <input type="text" name="telp" id="telp" class="form-control" placeholder="Nomor Telepon Anda" value="{{ old('telp', session('pengajuan')['telp'] ?? '') }}" required>
                                    @error('telp')
                                        <div class="text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-sm-6">
                                    <label for="email" class="block mb-2 text-sm font-medium text-blue-800">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Anda" value="{{ old('email', session('pengajuan')['email'] ?? '') }}" required>
                                </div>
                            </div>

                            {{-- <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-gradient-blue">Next</button>
                            </div> --}}
                            <div class="flex justify-content-end mt-4">
                                <button type="button" id="submitBtn" class="bg-gradient-to-r from-[#00008B] to-[#3B3BBD] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1">Next</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        form.submit();
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#jurusan').on('change', function () {
                var jurusan_id = $(this).find(':selected').data('id');
                if (jurusan_id) {
                    $.ajax({
                        url: '/getProdi/' + jurusan_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#prodi').empty();
                            $('#prodi').append('<option value="">--Pilih Prodi--</option>');
                            $.each(data, function (key, value) {
                                $('#prodi').append('<option value="' + value.nama_prodi + '">' + value.nama_prodi + '</option>');
                            });
                        }
                    });
                } else {
                    $('#prodi').empty();
                    $('#prodi').append('<option value="">--Pilih Prodi--</option>');
                }
            });
        });
        $(document).ready(function () {
            $('#ormawa').on('change', function () {
                var ormawa_id = $(this).find(':selected').data('id');
                if (ormawa_id) {
                    $.ajax({
                        url: '/getKetuaOrmawa/' + ormawa_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#ketua_ormawa').empty();
                            $('#ketua_ormawa').append('<option value="">--Pilih ketua ormawa--</option>');
                            $.each(data, function (key, value) {
                                $('#ketua_ormawa').append('<option value="' + value.nama_ketua + '">' + value.nama_ketua + '</option>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching ketua ormawa:', xhr.responseText);
                        }
                    });
                } else {
                    $('#ketua_ormawa').empty();
                    $('#ketua_ormawa').append('<option value="">--Pilih ketua ormawa--</option>');
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const status = @json(session('status', 'pengisian'));

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
                    document.getElementById("circle2").classList.replace("bg-gray-300", "bg-gradient-orange");
                    document.getElementById("status2").textContent = "Completed";
                    document.getElementById("status2").classList.add("text-gradient-orange");
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
@endsection
