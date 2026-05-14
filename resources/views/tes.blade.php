ublic function uploadMOU(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $currentYear = date('Y');
        $folderPath = 'app/public/PDF//Template_Surat_MOU';
        $publicPath = storage_path($folderPath);
        Storage::makeDirectory($folderPath);

        $filePath = $request->file('file')->move($publicPath,  $currentYear . '_TemplateSuratMOU.pdf') ? $currentYear . '_TemplateSuratMOU.pdf' : 'data gagal terupload';

        // $mahasiswas = User::where('role_id', 'mahasiswa')->get();
        // Notification::send($mahasiswas, new SKTerbitNotifikasi('sk_terbit'));

        return response()->json([
            'message' => 'File berhasil diunggah!',
            'path' => $filePath,
            'year' => $currentYear,
        ]);
    }