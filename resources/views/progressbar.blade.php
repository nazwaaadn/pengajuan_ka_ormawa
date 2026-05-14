<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stepper Component with Gradient Text using Tailwind CSS">
    <title>Stepper Component with Gradient Text</title>
    <!-- Tambahkan link CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan link ke ikon FontAwesome untuk ceklis -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Link ke file CSS eksternal di assets/css/style.css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-gray-50 flex justify-center items-start h-screen">

<!-- Stepper Container -->
<div class="flex items-start max-w-4xl mx-auto mt-32">
  <!-- Step 1 (Completed) -->
  <div class="w-full">
    <div class="flex items-center w-full">
      <!-- Lingkaran dengan warna gradasi oranye -->
      <div class="w-6 h-6 shrink-0 mx-[-1px] p-1 flex items-center justify-center rounded-full bg-gradient-orange">
        <!-- Gunakan ikon ceklis -->
        <i class="fas fa-check text-white text-xs"></i>
      </div>
      <!-- Garis penghubung dengan warna gradasi biru -->
      <div class="w-56 h-1 mx-2 rounded-lg line-gradient-blue"></div>
    </div>
    <div class="mt-1">
      <!-- Teks dengan warna gradasi oranye -->
      <h6 class="text-sm font-bold text-gradient-orange">Pengisian Form</h6>
      <p class="text-xs text-gradient-orange">Completed</p>
    </div>
  </div>
  
  <!-- Step 2 (Completed) -->
  <div class="w-full">
    <div class="flex items-center w-full">
      <!-- Lingkaran dengan warna gradasi oranye -->
      <div class="w-6 h-6 shrink-0 mx-[-1px] p-1 flex items-center justify-center rounded-full bg-gradient-orange">
        <!-- Gunakan ikon ceklis -->
        <i class="fas fa-check text-white text-xs"></i>
      </div>
      <!-- Garis penghubung dengan warna gradasi biru -->
      <div class="w-56 h-1 mx-2 rounded-lg line-gradient-blue"></div>
    </div>
    <div class="mt-1">
      <!-- Teks dengan warna gradasi oranye -->
      <h6 class="text-sm font-bold text-gradient-orange">Pengajuan Berkas</h6>
      <p class="text-xs text-gradient-orange">Completed</p>
    </div>
  </div>

  <!-- Step 3 (Pending) -->
  <div>
    <div class="flex items-center">
      <div class="w-6 h-6 shrink-0 mx-[-1px] p-1 flex items-center justify-center rounded-full bg-gray-300">
        <span class="text-xs text-white font-bold">3</span>
      </div>
    </div>
    <div class="mt-1">
      <!-- Ubah teks menjadi abu-abu jika step pending -->
      <h6 class="text-sm font-bold text-gray-pending">Verifikasi Berkas</h6>
      <p class="text-xs text-gray-pending">Pending</p>
    </div>
  </div>
</div>
<!-- End of Stepper Container -->

</body>
</html>
