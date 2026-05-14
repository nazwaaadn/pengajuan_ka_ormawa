{{-- <!DOCTYPE html> --}}
<html lang="id">

<head>
    @include('layouts.head')
    <title>Pengajuan Ketua ORMAWA</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@extends('components.main')
@include('layouts.head')
@include('components.navbar2staff')

@section('content')
<div class="w-full px-4 py-6 mx-auto" id="content">
    <!-- Tabel Pengajuan -->
    <div class="relative shadow-md rounded-lg overflow-auto pb-10 p-5 border border-gray-200 bg-white">
        <div class="w-full">
            <div class="my-5 text-sm flex space-x-4 ">
                <button
                    class="rekapilutasi-btn w-1/3 h-14 px-3 py-1 bg-[#E11818] text-white rounded-lg font-semibold shadow-md text-lg" >
                    Rekapitulasi Statistik
                </button>

                {{-- Untuk Upload SK --}}
                <button 
                    class="uploadMOU-btn w-1/3 h-14 px-3 py-1 bg-[#E11818] text-white rounded-lg font-semibold shadow-md text-lg" >
                    Upload Surat MOU {{ date('Y') }} 
                </button>
                
                <button 
                    class="uploadPersyaratan-btn w-1/3 h-14 px-3 py-1 bg-[#E11818] text-white rounded-lg font-semibold shadow-md text-lg" >
                    Upload Persyaratan Pengajuan {{ date('Y') }} 
                </button>
            </div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-[#295F98]">Tabel Pengajuan</h2>
                <div>
                    <label for="periode" class="text-sm mr-2">Periode</label>
                    <select id="periode" class="border border-gray-300 rounded-md p-1 w-32 text-xs">
                        <option value="">Semua Periode</option>
                        @foreach ($periodes as $periode)
                            <option value="{{ $periode }}" {{ $selectedPeriode === $periode ? 'selected' : '' }}>
                                {{ $periode }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <table class="w-full text-xs text-center text-gray-700">
                <thead class="text-xs uppercase border-b-2 border-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap">No <div>Pengajuan</div></th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap text-left">Nama</th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap text-left">Nim</th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap">Ketua <div>Ormawa</div></th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap">Periode</th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap">Tanggal Pengajuan</th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap">Status Verifikasi</th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap">Waktu Verifikasi</th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap">Verifikasi <div>Pengajuan</div></th>
                        <th scope="col" class="px-4 py-3 text-[#295F98] whitespace-nowrap">Surat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuans as $pengajuan)
                    <tr class="border-b text-center">
                        <td class="px-4 py-3 text-[#295F98]">{{ $pengajuan->id }}</td>
                        <td class="px-4 py-3 text-left text-[#295F98]">
                            {!! wordwrap($pengajuan->nama, 20, '<br>', true) !!}
                        </td>
                        <td class="px-4 py-3 text-left text-[#295F98]">{{ $pengajuan->nim }}</td>
                        <td class="px-4 py-3 text-left text-[#295F98]">
                            {!! wordwrap($pengajuan->ketua_ormawa, 20, '<br>', true) !!}
                        </td>
                        <td class="px-4 py-3 text-[#295F98]">{{ $pengajuan->periode }}</td>
                        <td class="px-4 py-3 text-[#295F98]">{{ \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat('j F Y') }}</td>
                        <td>
                            @if($pengajuan->status === \App\Enums\PengajuanStatus::MenungguVerifikasi)
                                <span class="w-24 h-8 px-3 py-1 bg-gradient-to-r from-[#6C7F9E] to-[#A3B3D3] text-white rounded-lg font-semibold shadow-md">
                                    Menunggu Verifikasi
                                </span>
                            @elseif($pengajuan->status === \App\Enums\PengajuanStatus::Diterima)
                                <span class="w-24 h-8 px-3 py-1 bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white rounded-lg font-semibold shadow-md">
                                    Diterima
                                </span>
                            @elseif($pengajuan->status === \App\Enums\PengajuanStatus::PerluRevisi)
                                <span class="w-24 h-8 px-3 py-1 bg-gradient-to-r from-[#E11818] to-[#FF7171] text-white rounded-lg font-semibold shadow-md">
                                    Perlu Revisi
                                </span>
                            @elseif($pengajuan->status === \App\Enums\PengajuanStatus::MenungguVerifikasiUlang)
                                <span class="w-24 h-8 px-3 py-1 bg-gradient-to-r from-[#6C7F9E] to-[#A3B3D3] text-white rounded-lg font-semibold shadow-md">
                                    Menunggu Verifikasi Ulang
                                </span>
                            @else
                                <span class="w-24 h-8 px-3 py-1 bg-gray-300 text-gray-800 rounded-lg font-semibold shadow-md">
                                    Tidak Diketahui
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-[#295F98]">{{ \Carbon\Carbon::parse($pengajuan->updated_at)->translatedFormat('j F Y') }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('pengajuan.detail', ['id' => $pengajuan->id]) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        @if ($pengajuan->status === \App\Enums\PengajuanStatus::Diterima)
                        <td class="px-4 py-3">
                            <a href="{{ route('surat.detail', ['id' => $pengajuan->id]) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                        @else
                            <td><p>Pengajuan Belum <div>Selesai</div></p></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Tombol Back to Dashboard -->
        <div class="mt-4">
            <a href="{{route('dashboard')}}" class="inline-block px-4 py-2 text-sm font-semibold text-white bg-[#295F98] rounded-lg shadow-md hover:bg-[#183d64]">
                <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
</div>

    @if (session('successDiterima'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Verifikasi Diterima !!',
                    text: '{{ session('successDiterima') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @elseif (session('successRevisi'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Verifikasi Revisi !!',
                    text: '{{ session('successRevisi') }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @endif
        
<script>
    const validatePengajuanUrl = "{{ route('validate-pengajuanStatus') }}";

    document.getElementById('periode').addEventListener('change', function () {
        const selectedPeriode = this.value;
        const url = new URL(window.location.href);
        if (selectedPeriode) {
            url.searchParams.set('periode', selectedPeriode);
        } else {
            url.searchParams.delete('periode');
        }
        window.location.href = url.toString();
    });

    document.addEventListener('click', function (event) {
            if (event.target.classList.contains('rekapilutasi-btn'))
        {
            event.preventDefault();

            // Validasi status pengajuan sebelum mengizinkan upload
            fetch(validatePengajuanUrl, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
            .then(response => response.json())
            .then(data => {
            if (!data.success) {
                // Jika validasi gagal, tampilkan jumlah status
                Swal.fire({
                    title: 'Tidak Dapat Upload SK',
                    html: `
                        <p>Terdapat pengajuan yang tidak memenuhi syarat untuk upload SK:</p>
                        <ul>
                            <li><strong>Menunggu Verifikasi:</strong> ${data['Menunggu Verifikasi']} pengajuan</li>
                            <li><strong>Menunggu Verifikasi Ulang:</strong> ${data['Menunggu Verifikasi Ulang']} pengajuan</li>
                            <li><strong>Perlu Revisi:</strong> ${data['Perlu Revisi']} pengajuan</li>
                            <li><strong>Diterima:</strong> ${data['Diterima']} pengajuan</li>
                        </ul>
                        <p>Pastikan semua pengajuan memiliki status <strong>"Diterima"</strong>.</p>
                    `,
                    icon: 'warning'
                });
                return;
            }})
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'Gagal memvalidasi status pengajuan.', 'error');
            });
        }
    });
</script>

{{-- Upload SK
<script>
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('upload-btn')) {
            event.preventDefault();

            Swal.fire({
                title: 'Upload SK',
                html: `
                    <form id="file-upload-form">
                        <input id="fileInput" type="file" name="file" accept="application/pdf" 
                            class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light text-[#FF9A36] transition duration-200 ease-in-out hover:-translate-y-1">
                        
                        <div id="filePreview" style="margin-top: 15px; display: none;">
                            <h5>Preview SK:</h5>
                            <iframe id="previewFrame" src="" width="100%" height="300px"></iframe>
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Upload',
                width: '50%',
                animation: false,
                preConfirm: () => {
                    const fileInput = document.getElementById('fileInput');
                    if (!fileInput.files.length) {
                        Swal.showValidationMessage('Harap pilih file terlebih dahulu!');
                        return false;
                    }
                    return fileInput.files[0]; 
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const file = result.value;

                    const formData = new FormData();
                    formData.append('file', file);

                    fetch('/upload-sk', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal mengunggah file.');
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire('Sukses!', 'File berhasil diunggah dan disimpan di server!', 'success');

                        sessionStorage.setItem('uploadedYears', data.year);
                        const buttonSecond = document.querySelector('.uploadSuccess-btn');
                        if (buttonSecond) {
                            buttonSecond.textContent = `SK Tahun ${data.year} Telah Diluncurkan. Klik Untuk Info Lebih Lanjut`;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Gagal mengunggah file.', 'error');
                    });
                }
            });

            // Menampilkan preview file
            document.getElementById('fileInput').addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file && file.type === 'application/pdf') {
                    const previewFrame = document.getElementById('previewFrame');
                    previewFrame.src = URL.createObjectURL(file); 
                    document.getElementById('filePreview').style.display = 'block';
                } else {
                    Swal.fire('Error!', 'Hanya file PDF yang diperbolehkan!', 'error');
                    e.target.value = ''; 
                }
            });
        }
    });
</script> --}}

{{-- Preview SK
<script>
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('uploadSuccess-btn')) {
            event.preventDefault();

            const fileUrl = event.target.getAttribute('data-file');

            Swal.fire({
                title: 'Preview SK',
                html: `
                    <div style="height: 500px; overflow: auto;">
                        <iframe src="${fileUrl}" width="100%" height="500px"></iframe>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                width: '50%',
                animation: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('/delete-sk', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ fileUrl: fileUrl })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Deleted!', 'File berhasil dihapus.', 'success');
                        } else {
                            Swal.fire('Error!', 'Gagal menghapus file.', 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus file.', 'error');
                    });
                }
            });
        }
    });
</script> --}}

<script>
const uploadMoUUrl = "{{ route('upload-mou') }}";

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('uploadMOU-btn')) {
        event.preventDefault();

        Swal.fire({
            title: 'Upload Template MoU',
            html: `
                <form id="file-upload-form">
                    <input id="fileInput" type="file" name="file" accept="application/pdf" 
                        class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light text-[#FF9A36] transition duration-200 ease-in-out hover:-translate-y-1">
                    
                    <div id="filePreview" style="margin-top: 15px; display: none;">
                        <h5>Preview Surat MoU:</h5>
                        <iframe id="previewFrame" src="" width="100%" height="300px"></iframe>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Upload',
            width: '50%',
            animation: false,
            preConfirm: () => {
                const fileInput = document.getElementById('fileInput');
                if (!fileInput.files.length) {
                    Swal.showValidationMessage('Harap pilih file terlebih dahulu!');
                    return false;
                }
                return fileInput.files[0]; 
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const file = result.value;

                const formData = new FormData();
                formData.append('file', file);

                fetch(uploadMoUUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengunggah file.');
                    return response.json();
                })
                .then(data => {
                    Swal.fire('Sukses!', 'File berhasil diunggah dan disimpan di server!', 'success');
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Gagal mengunggah file.', 'error');
                });
            }
        });
    }
});

const uploadPersyaratanPengajuanUrl = "{{ route('upload-persyaratanPengajuan') }}";
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('uploadPersyaratan-btn')) {
        event.preventDefault();

        Swal.fire({
            title: 'Upload Surat Persyaratan Pengajuan',
            html: `
                <form id="file-upload-form">
                    <input id="fileInputPersyaratan" type="file" name="file" accept="application/pdf" 
                        class="block w-full text-sm text-gray-900 cursor-pointer bg-white border-2 border-dashed border-[#FF9A36] rounded-md p-2 font-light text-[#FF9A36] transition duration-200 ease-in-out hover:-translate-y-1">
                    
                    <div id="filePreviewPersyaratan" style="margin-top: 15px; display: none;">
                        <h5>Preview Surat Persyaratan:</h5>
                        <iframe id="previewFrame" src="" width="100%" height="300px"></iframe>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Upload',
            width: '50%',
            animation: false,
            preConfirm: () => {
                const fileInput = document.getElementById('fileInputPersyaratan');
                if (!fileInput.files.length) {
                    Swal.showValidationMessage('Harap pilih file terlebih dahulu!');
                    return false;
                }
                return fileInput.files[0]; 
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const file = result.value;

                const formData = new FormData();
                formData.append('file', file);

                fetch(uploadPersyaratanPengajuanUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw new Error(err.message); });
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire('Sukses!', 'File berhasil diunggah dan disimpan di server!', 'success');
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', error.message || 'Gagal mengunggah file.', 'error');
                });
            }
        });
    }
});

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
