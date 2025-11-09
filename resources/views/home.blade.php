<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIKAPer | Sistem Keluhan Internal Karyawan Perusahaan</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 font-poppins min-h-screen flex flex-col">

  <!-- Navbar -->
  <nav class="bg-gray-900 text-white px-6 py-4 flex justify-between items-center shadow-md">
    <a href="#" class="text-xl font-bold tracking-wide">SIKAPer</a>
    <div class="space-x-3">
      <a href="/login" class="px-4 py-2 border border-white rounded-lg hover:bg-white hover:text-gray-900 transition">Login</a>
      <a href="/register" class="px-4 py-2 bg-yellow-400 text-gray-900 font-semibold rounded-lg hover:bg-yellow-300 transition">Register</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="flex-grow flex items-center justify-center px-4">
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-2xl w-full text-center">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">INFORMASI</h2>
      <p class="text-gray-600 mb-6">Petunjuk Penggunaan Sistem:</p>
      <ol class="text-left text-gray-700 space-y-2 list-decimal list-inside">
        <li>Registrasi atau buat akun terlebih dahulu</li>
        <li>Login menggunakan akun yang telah diregistrasi (<span class="font-semibold text-gray-900">level = karyawan</span>)</li>
        <li>Ajukan keluhan atau saran yang ingin disampaikan</li>
        <li>Monitor status keluhan/saran hingga status = <span class="font-semibold text-green-600">selesai</span></li>
        <li>Dapatkan follow-up dari tim HR/Manager</li>
        <li>Logout setelah selesai</li>
      </ol>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center text-gray-500 py-4 text-sm">
    &copy; {{ date('Y') }} SIKAPer — Sistem Keluhan Internal Karyawan Perusahaan
  </footer>

</body>
</html>
