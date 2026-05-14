@extends('components.main')
@include('layouts.head')
@include('components.navbar2staff')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    @if ($pengajuans->status === \App\Enums\PengajuanStatus::MenungguVerifikasiUlang)
    <div class="bg-red-400 shadow-lg rounded-lg p-6 my-8">
        <h3 class="text-2xl font-bold text-center text-black mb-5">Pesan Revisi Sebelumnya</h3>
        <p>{{ $pengajuans->keterangan }}</p>
    </div>
    @endif
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-bold text-center text-[#344767]">DATA PENGAJUAN</h3>
        <div class="mt-6 border-t border-gray-200">
            <dl class="divide-y divide-gray-200 text-center">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">NO PENGAJUAN</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->id }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">NAMA</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->nama }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">NIM</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->nim }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">JURUSAN</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->jurusan }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">PRODI</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->prodi }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">JENIS ORMAWA</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->ormawa }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">ORMAWA</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->ketua_ormawa }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">PERIODE</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->periode }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">NO. TELP</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->telp }}</dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-[#344767]">EMAIL</dt>
                        <dd class="mt-1 text-sm text-[#295F98] sm:col-span-2 sm:mt-0">{{ $pengajuans->email }}</dd>
                    </div>
                </dl>
            </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 my-8">
        <h2 class="text-2xl font-bold text-center text-[#344767] pb-6">BERKAS - BERKAS PENGAJU</h2>
        @foreach ($files as $title => $filename)
            @if ($filename)
                <h3 class="text-center text-xl font-bold text-[#344767] py-2 ">{{ $title }}</h3>
                <iframe class="mx-auto pb-10" src="{{ route('file.show', ['id' => $pengajuans->id, 'filename' => $filename]) }}" 
                        width="50%" height="600"></iframe>
            @endif
        @endforeach
    </div>

    {{-- <div class="bg-white shadow-lg rounded-lg p-6 my-8">
        <h2 class="text-2xl font-bold text-center text-[#344767]">BERKAS - BERKAS</h2>
        <div class="mb-10 mt-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2 ">Scan KTP</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_scan_ktp.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Surat Sehat</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_surat_sehat.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Surat Rekomendasi Jurusan</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_surat_rekomendasi_jurusan.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Transkrip Rekomendasi Jurusan</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_transkip_rekomendasi_jurusan.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Sertifikat LKMM</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_sertifikat_lkmm.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Sertifikat Pelatihan Kepemimpinan</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_sertifikat_pelatihan_kepemimpinan.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Sertifikat Pelatihan Emosional</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_sertifikat_pelatihan_emosional_spiritual.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Sertifikat Bahasa Asing</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_sertifikat_bahasa_asing.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Scan KTM</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_scan_ktm.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Surat Keterangan Berkelakuan Baik</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_surat_keterangan_berkelakuan_baik.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Surat Pernyataan Mandiri</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_surat_penyataan_mandiri.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Sertifikat PKKMB</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_sertifikat_pkkmb.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Sertifikat Bela Negara</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_sertifikat_bela_negara.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Sertifikat Agent of Change</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_sertifikat_agent_of_change.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Sertifikat Berorganisasi</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_sertifikat_berorganisasi.pdf') }}" width="50%" height="600px"></iframe>
        </div>
        <div class="mb-10">
            <h3 class="text-center text-xl font-bold text-[#344767] py-2">Berita Acara Pemilihan</h3>
            <iframe class="mx-auto" src="{{ asset('storage/PDF/' . $pengajuans->id . '/' .'Pengaju_' . $pengajuans->id . '_berita_acara_pemilihan.pdf') }}" width="50%" height="600px"></iframe>
        </div>

    </div> --}}

    <div class="flex justify-between items-center mt-4">
        <!-- Tombol Revisi -->
        <button id="btnRevisi" class="bg-gradient-to-r from-[#FF7F00] to-[#FF9A36] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1">
            Revisi
        </button>

        <!-- Script SweetAlert untuk Revisi -->
        <script>
            document.getElementById('btnRevisi').addEventListener('click', function () {
            Swal.fire({
                title: 'Revisi Pengajuan',
                html: `
                    <div style="text-align: left">
                       <p style="color: red; font-size: 0.65em;">*Checklist bagian yang tidak sesuai, serta tambahan keterangan jika dibutuhkan</p>
                        <label><input type="checkbox" value="Scan KTP tidak sesuai | "> 1. Scan KTP</label><br>
                        <label><input type="checkbox" value="Surat Sehat tidak sesuai | "> 2. Surat Sehat</label><br>
                        <label><input type="checkbox" value="Surat Rekomendasi Jurusan tidak sesuai | "> 3.  Surat Rekomendasi Jurusan</label><br>
                        <label><input type="checkbox" value="Transkip Rekomendasi Jurusan(IPK) tidak sesuai | "> 4. Transkip Rekomendasi Jurusan (IPK)</label><br>
                        <label><input type="checkbox" value="Sertifikat LKMM tidak sesuai | "> 5. Sertifikat LKMM</label><br>
                        <label><input type="checkbox" value="Sertifikat Pelatihan Kepemimpinan tidak sesuai | "> 6. Sertifikat Pelatihan Kepemimpinan</label><br>
                        <label><input type="checkbox" value="Sertifikat Pelatihan Emotional Spiritual tidak sesuai | "> 7. Sertifikat Pelatihan Emotional Spiritual</label><br>
                        <label><input type="checkbox" value="Sertifikat Bahasa Asing(EPT) tidak sesuai | "> 8. Sertifikat Bahasa Asing (EPT)</label><br>
                        <label><input type="checkbox" value="Scan KTM tidak sesuai | "> 9. Scan KTM</label><br>
                        <label><input type="checkbox" value="Surat Keterangan Berkelakuan Baik tidak sesuai | "> 10. Surat Keterangan Berkelakuan Baik</label><br>
                        <label><input type="checkbox" value="Surat Pernyataan Mandiri tidak sesuai | "> 11. Surat Pernyataan Mandiri</label><br>
                        <label><input type="checkbox" value="Sertifikat PKKMB tidak sesuai | "> 12. Sertifikat PKKMB</label><br>
                        <label><input type="checkbox" value="Sertifikat Bela Negara tidak sesuai | "> 13. Sertifikat Bela Negara</label><br>
                        <label><input type="checkbox" value="Sertifikat Agent of Change tidak sesuai | "> 14. Sertifikat Agent of Change</label><br>
                        <label><input type="checkbox" value="Sertifikat Berorganisasi tidak sesuai | "> 15. Sertifikat Berorganisasi</label><br>
                        <label><input type="checkbox" value="Berita Acara Pemilihan tidak sesuai | "> 16. Berita Acara Pemilihan</label><br>
                        <textarea style="width: 80%; height: 100px;" id="customRevisi" class="swal2-textarea" placeholder="Tulis revisi tambahan (opsional)"></textarea>
                    </div>
                `,
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Tolak dan Revisi',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    // Ambil semua checkbox yang diceklis
                    const checkedValues = Array.from(
                        document.querySelectorAll('input[type="checkbox"]:checked')
                    ).map(checkbox => checkbox.value);

                    // Ambil teks tambahan dari textarea
                    const customRevisi = document.getElementById('customRevisi').value;

                    // Gabungkan revisi dari checkbox dan teks tambahan
                    const revisiText = [...checkedValues, customRevisi.trim()].filter(Boolean).join('\n');

                    if (!revisiText) {
                        Swal.showValidationMessage('Anda harus memilih setidaknya satu revisi atau mengisi keterangan tambahan.');
                    }
                    return revisiText;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim revisi ke server
                    fetch("{{ route('pengajuan.updateStatus', ['id' => $pengajuans->id, 'status' => 'Perlu Revisi']) }}", {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ revisi: result.value })
                    })
                        .then(response => response.json())
                        .then(data => {
                                window.location.href =  "{{ route('listtable') }}";
                        })
                        .catch(error => {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan revisi.', 'error');
                        });
                }
            });
        });
        </script>

        <form action="{{ route('pengajuan.updateStatus', ['id' => $pengajuans->id, 'status' => 'Diterima']) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            {{-- <button type="submit" class="btn btn-success text-white py-2 px-4 rounded" id="btnTerima" style="position: relative; z-index: 1;">
                Terima
            </button> --}}

            <button type="submit" class="bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1 mt-4">Terima</button>
        </form>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<!-- Script to handle modal toggle (using Alpine.js) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.0/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
