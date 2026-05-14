@extends('components.main')
@include('layouts.head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@include('components.navbar2')

@section('content')
    <div class="w-full px-4 py-6 mx-auto" id="content">
    <section class="bg-blue">
        <div class="container my-4">

            <div class="bg-red-400 shadow-lg rounded-lg p-6 my-8">
                <h3 class="text-2xl font-bold text-center text-black mb-5">Pesan Revisi</h3>
                <p>{{ $pengajuan->keterangan }}</p>
            </div>

            <!-- Stepper Container -->
            <div class="flex items-start max-w-4xl mx-auto mt-5">
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
                        <h6 class="text-sm font-bold text-gray-500">Pengajuan Berkas</h6>
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
                        <h6 class="text-sm font-bold text-gray-500">Verifikasi Berkas</h6>
                        <p class="text-xs text-gray-500" id="status3">Pending</p>
                    </div>
                </div>
            </div>
            <!-- End of Stepper Container -->


            <section class="bg-blue">
                <div class="py-8 px-4 mx-auto">
                    <h3 class="mb-4 text-xl font-bold text-blue-800 text-center">Revisi Pengajuan</h3>
                    <form action="{{ route('pengajuan.update', ['nim' => $pengajuan->nim, 'id' => $pengajuan->id]) }}" method="POST" enctype="multipart/form-data" id="applicationForm">
                        @csrf
                        @method('PUT') <!-- Method spoofing for PUT -->

                        <!-- Mengatur Grid Layout 2 kolom -->
                        <div class="row g-4">
                            <!-- Nama -->
                            <div class="col-12">
                                <label for="nama" class="block mb-2 text-sm font-medium text-blue-800">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" required value="{{ $pengajuan->nama }}" required>
                            </div>

                            <!-- NIM -->
                            <div class="col-12">
                                <label for="nim" class="block mb-2 text-sm font-medium text-blue-800">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control" placeholder="NIM Lengkap" required value="{{ $pengajuan->nim }}" required>
                                @if ($errors->has('nim'))
                                    <div class="text-red-500">
                                        {{ $errors->first('nim') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Jurusan -->
                            <div class="col-xl-12">
                                <label for="jurusan" class="block mb-2 text-sm font-medium text-blue-800">Pilih Jurusan:</label>
                                <select id="jurusan" name="jurusan" class="form-select" required>
                                    <option value="">--Pilih Jurusan--</option>
                                    @foreach($jurusans as $jurusan)
                                        <option value="{{ $jurusan->nama_jurusan }}"
                                                {{ $pengajuan->jurusan == $jurusan->nama_jurusan ? 'selected' : '' }}
                                                data-id="{{ $jurusan->id_jurusan }}">{{ $jurusan->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Prodi -->
                            <div class="col-xl-12">
                                <label for="prodi" class="block mb-2 text-sm font-medium text-blue-800">Pilih Prodi:</label>
                                <select id="prodi" name="prodi" class="form-select" required>
                                    <option value="">--Pilih Prodi--</option>
                                    @foreach($prodis as $prodi)
                                        <option value="{{ $prodi->nama_prodi }}"
                                                {{ $pengajuan->prodi == $prodi->nama_prodi ? 'selected' : '' }}
                                                data-id="{{ $prodi->id_prodi }}">{{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Periode -->
                            <div class="col-xl-12">
                                <label for="periode" class="block mb-2 text-sm font-medium text-blue-800">Periode</label>
                                <select name="periode" id="periode" class="form-select" required>
                                    <option value="" disabled selected>Pilih Periode</option>
                                    <option value="2024-2025" {{ $pengajuan->periode == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                                    {{-- <option value="2025-2026" {{ $pengajuan->periode == '2025-2026' ? 'selected' : '' }}>2025-2026</option>
                                    <option value="2026-2027" {{ $pengajuan->periode == '2026-2027' ? 'selected' : '' }}>2026-2027</option>
                                    <option value="2027-2028" {{ $pengajuan->periode == '2027-2028' ? 'selected' : '' }}>2027-2028</option>
                                    <option value="2028-2029" {{ $pengajuan->periode == '2028-2029' ? 'selected' : '' }}>2028-2029</option> --}}
                                    {{-- <option value="2020" {{ $pengajuan->periode == '2020' ? 'selected' : '' }}>2020-2021</option>
                                    <option value="2021" {{ $pengajuan->periode == '2021' ? 'selected' : '' }}>2021-2022</option>
                                    <option value="2022" {{ $pengajuan->periode == '2022' ? 'selected' : '' }}>2022-2023</option> --}}
                                </select>
                            </div>

                            <div class="col-xl-12">
                                <label for="ormawa" class="block mb-2 text-sm font-medium text-blue-800">Ormawa</label>
                                <select id="ormawa" name="ormawa" class="form-select" required>
                                    <option value="">--Pilih Ormawa--</option>
                                    @foreach($ormawas as $ormawa)
                                        <option value="{{ $ormawa->nama_ormawa }}"
                                                {{ $pengajuan->ormawa == $ormawa->nama_ormawa ? 'selected' : '' }}
                                                data-id="{{ $ormawa->id_ormawa }}">{{ $ormawa->nama_ormawa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Ketua Ormawa -->
                            <div class="col-xl-12">
                                <label for="ketua_ormawa" class="block mb-2 text-sm font-medium text-blue-800">Pilih ketua ormawa:</label>
                                <select id="ketua_ormawa" name="ketua_ormawa" class="form-select" required>
                                    <option value="">--Pilih Ketua Ormawa--</option>
                                    @foreach($ketuaOrmawas as $kt)
                                        <option value="{{ $kt->nama_ketua }}"
                                                {{ $pengajuan->ketua_ormawa == $kt->nama_ketua ? 'selected' : '' }}
                                                data-id="{{ $kt->id_ketua_ormawa }}">{{ $kt->nama_ketua }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- No. Telepon -->
                            <div class="col-sm-6">
                                <label for="telp" class="block mb-2 text-sm font-medium text-blue-800">No. Telepon</label>
                                <input type="text" name="telp" id="telp" class="form-control" placeholder="Nomor Telepon Anda" required value="{{ $pengajuan->telp }}" required>
                            </div>

                            <!-- Email -->
                            <div class="col-sm-6">
                                <label for="email" class="block mb-2 text-sm font-medium text-blue-800">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email Anda" required value="{{ $pengajuan->email }}" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" id="submitBtn" class="bg-gradient-to-r from-[#00008B] to-[#3B3BBD] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1">Update</button>
                        </div>
                    </form>
                </div>
            </section>


        </div>
    </section>

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
         document.addEventListener("DOMContentLoaded", function() {
            const step1Circle = document.getElementById("circle1");
            const step1StatusText = document.getElementById("status1");
            const step1TitleText = document.getElementById("textStep1");
            const progressStep = document.getElementById("progressStep1");
            const form = document.getElementById("applicationForm");
            const formFields = form.querySelectorAll("input, select, textarea");  // Select all input, select, and textarea elements

            function checkStep1Completion() {
                let isCompleted = true;

                formFields.forEach(field => {
                    if (field.type !== "submit" && field.value.trim() === "") {
                        isCompleted = false;
                    }
                });

                if (isCompleted) {
                    // Update Step 1 as completed
                    step1Circle.classList.replace("bg-gray-300", "bg-gradient-orange");
                    step1Circle.querySelector("i").classList.remove("hidden");
                    step1StatusText.textContent = "Completed";
                    step1TitleText.classList.replace("text-gray-500", "text-gradient-orange");
                    step1StatusText.classList.replace("text-gray-500", "text-gradient-orange");
                    progressStep.classList.replace('bg-gray-300','line-gradient-blue')
                } else {
                    // Revert Step 1 to pending
                    step1Circle.classList.replace("bg-gradient-orange", "bg-gray-300");
                    step1Circle.querySelector("i").classList.add("hidden");
                    step1StatusText.textContent = "Pending";
                    step1TitleText.classList.replace("text-gradient-orange", "text-gray-500");
                    step1StatusText.classList.replace("text-gradient-orange", "text-gray-500");
                    progressStep.classList.replace('line-gradient-blue','bg-gray-300')
                }
            }

            // Attach event listeners to all form fields for real-time status updates
            formFields.forEach(field => {
                field.addEventListener("input", checkStep1Completion);
                field.addEventListener("change", checkStep1Completion); // for select fields
            });

            // Initial check on load
            checkStep1Completion();
        });
    </script>
@endsection
