<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo File</title>

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}"> --}}

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .kop-surat {
            font-family: 'Times New Roman';
            display: flex;
            align-items: flex-start; /* Pastikan elemen sejajar dari atas */
            margin-bottom: 20px;
            padding: 20px 20px 0 20px; /* Ruang di sekitar kop */
            position: relative; /* Untuk mengatur elemen di dalamnya */
        }
        .kop-surat .logo img {
            width: 80px;
            height: auto;
            margin-top: -10px;
            margin-right: 20px; /* Jarak dengan isi kop */
        }
        .kop-surat .isi-kop {
            text-align: center;
            flex-grow: 1;
            margin-top: -150px;
            margin-left: 50px;
        }
        .kop-surat .isi-kop h1{
            /* font-size: 16px !important; */
            font-size: 16pt !important;
            text-align: center;
            margin: 0;
            font-weight: normal;
        }
        .kop-surat .isi-kop h2{
            /* font-size: 14px !important; */
            font-size: 14pt !important;
            text-align: center;
            margin: 5px 0;
        }
        .kop-surat .isi-kop h3{
            /* font-size: 12px !important; */
            font-size: 11pt !important;
            text-align: center;
            margin: 5px 0;
            font-weight: normal;
            margin-left: 10px
        }
        .kop-surat hr {
            border: 0;
            border-top: 2px solid black; /* Ketebalan garis */
            margin-top: 10px;
            width: 100%; /* Membuat garis memanjang ke seluruh lebar container */
            position: absolute; /* Untuk memastikan hr tetap */
            left: 0; /* Mulai dari ujung kiri container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* margin-top: 20px; */
            /* font-size: 14px; */
            font-size: 9pt;
        }

        table th {
            background-color: #f2f2f2;
        }

        .validasi-status {
            text-align: center;
            width: 150px; /* Sesuaikan lebar kolom status */
        }

        .isi-surat{
            font-family: Arial, sans-serif;
        }
        /* Menyesuaikan layout dengan ukuran kertas */
        @media print {
            body {
                width: 210mm;
                height: 297mm;
                padding: 10mm;
            }
            .kop-surat {
                margin-bottom: 30px;
            }
        }

        p, td{
            /* font-size: 12px; */
            font-size: 9pt;
        }
    </style>

</head>
<body>

    <div class="kop-surat">
        {{-- <img src="{{ $image }}" alt="Logo" style="width: 80px; height: auto; margin-top: -10px; margin-right: 20px; /* Jarak dengan isi kop */"> --}}
        <div class="logo">
            {{-- <img src="{{ $image }}" alt="Logo"> --}}
            <img src="assets/img/polban2.png" alt="Logo">
        </div>
        <div class="isi-kop">
            {{-- <h1 style="font-size: 20px !important; text-align: center; margin: 0; font-weight: normal;">KEMENTERIAN PENDIDIKAN TINGGI, SAINS,<br> DAN TEKNOLOGI</h1> --}}
            <h1>KEMENTERIAN PENDIDIKAN TINGGI, SAINS,<br>DAN TEKNOLOGI</h1>
            <h2>POLITEKNIK NEGERI BANDUNG</h2>
            <h3>
                Jalan Gegerkalong Hilir, Desa Ciwaruga, Kecamatan Parongpong,<br>
                Kabupaten Bandung Barat 40559, Kotak Pos 1234, Telepon: (022) 2013789,<br>
                Faksimile: (022) 2013889, Laman: www.polban.ac.id,  Pos elektronik: polban@polban.ac.id
            </h3>
            <hr>
        </div>
    </div>

    <div class="isi-surat">
        <div class="pembukaan">
            <h4 style="text-align: center; margin: 9px">SURAT PERNYATAAN CALON KETUA ORGANISASI MAHASISWA</h4>

            @foreach ($pengajuans as $pengajuan)
            <p class="sm-10" style="margin-top: 0 !important">
                Saya yang bertanda tangan di bawah ini:
            </p>
            <table>
                <tr>
                    <td> Nama</td>
                    <td>:</td>
                    <td>{{ $pengajuan->nama }}</td>
                </tr>
                <tr>
                    <td> NIM</td>
                    <td>:</td>
                    <td>{{ $pengajuan->nim }}</td>
                </tr>
                <tr>
                    <td>Prodi/Jurusan</td>
                    <td>:</td>
                    <td>{{ $pengajuan->prodi }} / {{ $pengajuan->jurusan }}</td>
                </tr>
                <tr>
                    <td>Organisasi</td>
                    <td>:</td>
                    <td>{{ $pengajuan->ormawa }} / {{ $pengajuan->ketua_ormawa }}</td>
                </tr>
                <tr>
                    <td>Periode/Tahun</td>
                    <td>:</td>
                    <td>{{ $pengajuan->periode }}</td>
                </tr>
                <tr>
                    <td>No. Pengajuan</td>
                    <td>:</td>
                    <td>{{ $pengajuan->id }}</td>
                </tr>
            </table>
            <p style="text-align: justify">
                Dengan ini menyatakan dengan sebenar benarnya dan tanpa paksanaan dari manapun untuk bersedia menjadi ketua organisasi {{ $pengajuan->ketua_ormawa }}.
            </p>
            @endforeach
        </div>

        <div class="keterangan">

            <table class="validasi">
                <thead>
                    <tr>
                        <th style="border: 1px solid black;">NO</th>
                        {{-- <th>PERSYARATAN</th> --}}
                        <th style="border: 1px solid black;">KETERANGAN</th>
                        <th class="validasi-status" style="border: 1px solid black;">TERVALIDASI</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($berkas as $no => $ket)
                    <tr>
                        <td style="border: 1px solid black; text-align:center; padding: 0 10px 0 10px">{{ $loop->iteration }}</td>
                        <td style="border: 1px solid black; padding-left: 20px">{{ $ket }}</td>
                        @foreach ($pengajuans as $pengajuan)
                        <td style="border: 1px solid black; text-align: center">
                            {{-- @if ($pengajuan->status === \App\Enums\PengajuanStatus::Diterima) --}}
                            TERVALIDASI
                            {{-- @else --}}
                            {{-- Belum Tervalidasi --}}
                            {{-- @endif --}}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="penutup">
            <p style="text-align: justify">
                Surat pernyataan ini saya buat dalam keadaan sadar demi kemajuan Polban dan saya tidak pernah terkena surat peringatan SP baik dalam bidang akademik dan kemahasiswaan. Apabila dikemudian hari ternyata tidak sesuai dengan persyaratan diatas, maka saya bersedia untuk berhenti sebagai ketua ormawa dan di proses sesuai aturan dan hukum yang berlaku.<br>
                Demikian surat pernyataan ini dibuat agar dipergunakan sebagaimana perlunya.
            </p>
        </div>

        <div class="pengesahan">
            <table style="width: 100%; border-collapse: collapse; margin-bottom:0, padding-bottom: 0">
                <tr>
                    <td>
                        <p>
                            Mengetahui,<br>
                            Ketua Jurusan,
                        </p>
                    </td>
                    <td>
                        <p style="margin-left: 300px">
                            Bandung,<br>
                            Yang menyatakan,
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="border-top: 1px solid black; width: 200px; left: 0; margin-top: 75px"></div>
                    </td>
                    <td>
                        @foreach ($pengajuans as $pengajuan) <p style="margin: 55px 0 5 300px"> {{ $pengajuan->nama }} </p> @endforeach
                        <div style="border-top: 1px solid black; width: 200px; margin-left: 300px; right: 0;"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            NIP.
                        </p>
                    </td>
                    <td>
                        @foreach ($pengajuans as $pengajuan)
                        <p style="margin-left: 300px">
                            NIM. {{ $pengajuan->nim }}
                        </p>
                        @endforeach
                    </td>
            </table>

            <p style="font-size: 8pt">

                {{-- Keterangan: yang menyatakan harus tanda tangan basah diatas materai, besertakan cap jurusan<br>
                (bukan digital/scan) kecuali diijinkan karena alasan peraturan kesehatan. --}}

                Keterangan: keduanya harus tanda tangan basah (bukan digital/scan), kecuali diizinkan karena alasan kesehatan.<br>
                Untuk bagian yang menyatakan, tanda tangan di atas materai; untuk ketua jurusan, tanda tangan disertai cap basah jurusan.
            </p>
        </div>

    </div>

</body>
</html>
