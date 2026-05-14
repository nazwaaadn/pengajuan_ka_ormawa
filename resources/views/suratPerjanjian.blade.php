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
            font-family: 'Times New Roman';
            margin: 0;
            padding: 0;
        }
        .kop-surat {
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
            margin-top: 20px;
            /* font-size: 12px; */
            font-size: 9pt;
        }

        table th {
            background-color: #f2f2f2;
        }

        .validasi-status {
            text-align: center;
            width: 150px; /* Sesuaikan lebar kolom status */
        }
        /* Menyesuaikan layout dengan ukuran kertas */
        @media print {
            body {
                width: 210mm;
                height: 297mm;
                /* padding: 10mm; */
                padding: 5mm; /* Gunakan margin kecil saat dicetak */
            }
            .kop-surat {
                margin-bottom: 30px;
            }

            .kop-surat .isi-kop h1, .kop-surat .isi-kop h2, .kop-surat .isi-kop h3 {
                margin: 0;
            }
        }

        .isi-surat {
            font-family: Arial, sans-serif;
            /* font-size: 9pt; */
        }

        p, td{
            font-family: Arial, sans-serif;
            /* font-size: 11.5px; */
            font-size: 9pt;
        }
    </style>

</head>
<body>

    <div class="kop-surat">
        <div class="logo">
            {{-- <img src="{{ $image }}" alt="Logo" style="width: 80px; height: auto; margin-top: -10px; margin-right: 20px; /* Jarak dengan isi kop */"> --}}
            <img src="assets/img/polban2.png" alt="Logo">
        </div>
        <div class="isi-kop">
            {{-- <h1>KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</h1> --}}
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
            <h4 style="text-align: center; margin: 9px">PERJANJIAN KINERJA ORMAWA</h4>

            <p style="margin-top: 0 !important">
                Dalam rangka mewujudkan manajemen pemerintahan yang efektif, transparan dan akuntabel serta berorientasi pada hasil, yang bertanda tangan di bawah ini:
            </p>
        </div>

        {{-- <table>
            <tr>
                <td style="width: 15%;">Nama 1</td>
                <td style="width: 5%;">:</td>
                <td style="width: 30%;"></td>
                <td style="width: 15%;">Nama 2</td>
                <td style="width: 5%;">:</td>
                <td style="width: 30%;"></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td></td>
                <td>Jabatan</td>
                <td>:</td>
                <td></td>
            </tr>
        </table> --}}

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 0px; margin-top:0;">
            @foreach ($pengajuans as $pengajuan)
                <tr>
                    <td style="width: 20%;">Nama Ormawa</td>
                    <td style="width: 3%;">:</td>
                    <td style="width: 77%;">{{ $pengajuan->ormawa }} / {{ $pengajuan->ketua_ormawa }}</td>
                    {{-- <td style="width: 77%;"> {{ $pengajuan->ketua_ormawa }}</td> --}}
                </tr>
                <tr>
                    <td>Nama Ketua Ormawa</td>
                    <td>:</td>
                    <td>{{ $pengajuan->nama }}</td>
                </tr>
            @endforeach
            <tr>
                <td>Nama Pembina Ormawa</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>

        <p>
            Selanjutnya disebut pihak pertama
        </p>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 0px; margin-top:0;">
            <tr>
                <td style="width: 20%;">Nama</td>
                <td style="width: 3%;">:</td>
                <td style="width: 77%;"></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Wakil Direktur III Bidang Kemahasiswaan</td>
            </tr>
        </table>

        <p>
            Selaku penanggungjawab kegiatan pihak pertama, selanjutnya disebut pihak kedua
        </p>

        <p>
            Pihak pertama berjanji akan mewujudkan target kinerja yang seharusnya sesuai lampiran perjanjian ini, dalam rangka mencapai target kinerja jangka menegah seperti yang telah ditetapkan dalam dokumen perencanaan. Keberhasilan dan kegagalan pencapaian target kinerja tersebut menjadi tanggung jawab kami.
        </p>

        <p>
            Pihak kedua akan melakukan supervisi yang diperlukan serta melakukan evaluasi terhadap capaian kinerja dari perjanjian ini dan mengambil tindakan yang diperlukan dalam penghargaan dan sanksi.
        </p>

        <div class="sasaran">
            <table style="width: 100%; border-collapse: collapse; margin-top: 0px;">
                <tr>
                    <th style="border: 1px solid black; width: 30%;">Sasaran</th>
                    <th style="border: 1px solid black; width: 50%;">Indikator Kinerja</th>
                    <th style="border: 1px solid black; width: 20%;">Isian</th>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;" rowspan="10">Meningkatnya Kualitas Mahasiswa</td>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah mahasiswa mengikuti Program Kreativitas Mahasiswa (PKM)</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah mahasiswa mengikuti program kewirausahaan (PMW, KBMK)</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah mahasiswa mengikuti ajang prestasi (MaPres, Kompetisi, Lomba, Porseni, Sertifikasi) min. Level nasional</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah mahasiswa mengikuti program pengabdian (POMN, Bina Desa, PengMasy, Bakti Sosial, KKN, Polban Mengajar)</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah mahasiswa mengikuti kegiatan pendidikan karakter min. skala nasional yang melibatkan pihak luar (rapat, workshop, pelatihan, LKMM, LKO)</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah kegiatan kompetisi yang diikuti min. berskala nasional</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah kegiatan kompetisi yang diadakan min. berskala kotamadya dengan level SLTA/ perguruan tinggi</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah anggota</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah program kerja yang diajukan</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Jumlah pergerakan yang diajukan</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px; padding-left: 10px;" rowspan="2">Meningkatnya Kinerja dan Akuntabilitas Keuangan Negara</td>
                    {{-- <td style="border: 1px solid black; padding-left: 10px;">Durasi maksimal penyerahan SPJ/LPJ Monev Awal</td> --}}
                    <td style="border: 1px solid black; padding-left: 10px;">Durasi maksimal penyerahan SPJ/LPJ</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; padding-left: 10px;">Presentasi jumlah SPJ dan LPJ yang diserahkan Monev Akhir</td>
                    <td style="border: 1px solid black; text-align:center;"></td>
                </tr>
            </table>
        </div>

        <div class="pengesahan">
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <tr>
                    <td>Bandung, </td>
                </tr>
                <tr>
                    <td>Pihak Kedua,</td>
                    <td style="width: 50%; padding: 0 10px 0 10px; text-align: center;" colspan="2">Pihak Pertama,</td>
                </tr>
                <tr>
                    <td>
                        <div style="border-top: 1px solid black; width: 200px; margin-top: 70px;"></div>
                    </td>
                    <td>
                        <div style="border-top: 1px solid black; width: 200px; margin-top: 70px;"></div>
                    </td>
                    <td>
                        @foreach ($pengajuans as $pengajuan)
                            <p style="margin: 50px 0 5px 0"> {{ $pengajuan->nama }} </p>
                        @endforeach
                        <div style="border-top: 1px solid black; width: 200px;"></div>
                    </td>
                </tr>
                <tr>
                    <td>WaDir III Bidang Kemahasiswaan</td>
                    @foreach ($pengajuans as $pengajuan)
                    <td>Pembina {{ $pengajuan->ketua_ormawa }}</td>
                    <td>Ketua {{ $pengajuan->ketua_ormawa }}</td>
                    @endforeach
                </tr>
            </table>

            <p style="font-size: 8pt; margin-top: 7px;">
                Keterangan: keduanya harus tanda tangan basah (bukan digital/scan), kecuali diizinkan karena alasan kesehatan.<br>
                Untuk bagian pihak pertama, tanda tangan di atas materai; untuk pihak kedua, harus tanda tangan basah
            </p>
        </div>
    </div>

</body>
</html>
