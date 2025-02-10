<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sawala - Ruang Diskusi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Mega:wght@100..900&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css"> <!-- Tetap gunakan file CSS kamu -->
</head>
<body class="bg-[#DFE5F2] text-[#1A1A1A] font-sans">
  <!-- Header -->
  <header class="flex flex-wrap justify-between items-center p-6 bg-[#DFE5F2] sticky top-0 z-50">
    <div class="text-3xl font-bold text-[#1A1A1A]">Sawala</div>
    <nav class="hidden sm:flex space-x-4 text-gray-800 font-semibold">
      <a href="#" class="border-2 border-gray-800 rounded-full px-3 py-1 hover:bg-violet">Home</a>
      <a href="#features" class="border-2 border-transparent rounded-full px-3 py-1 hover:font-bold">Features</a>
      <a href="#services" class="border-2 border-transparent rounded-full px-3 py-1 hover:font-bold">Services</a>
    </nav>
    <a href="pages/login.php" class="px-4 py-2 mt-4 sm:mt-0 bg-[#1A1A1A] text-[#FFFFFF] rounded-xl font-bold hover:bg-[#333333]">
      Login here
    </a>
  </header>

  <!-- Main Content -->
  <main class="flex flex-col-reverse lg:flex-row items-center justify-around px-6 py-12 space-y-10 lg:space-y-0 lg:space-x-10">
    <!-- Left Section -->
    <div class="max-w-lg text-center lg:text-left">
      <h2 class="text-4xl lg:text-6xl font-extrabold text-gray-900 mb-6">
        Platform untuk Diskusi dan Kolaborasi
      </h2>
      <p class="text-gray-800 text-base lg:text-lg">
        Sawala membuka ruang untuk berpendapat, berdiskusi, dan berkolaborasi dalam komunitas yang inklusif.
      </p>
      <a href="pages/register.php" class="px-6 py-3 mt-6 bg-[#FFDB58] shadow-brutal btn-brutal border-brutal text-black font-bold text-lg rounded-xl hover:bg-[#FF7000] inline-flex items-center">
        Get Started
        <i class="fa-solid fa-arrow-right ml-2"></i>
      </a>
    </div>

    <!-- Right Section -->
    <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-6 sm:space-y-0 items-center">
      <!-- Person 1 -->
      <div class="relative bg-[#FFFFFF] shadow-brutal border-brutal rounded-lg p-4">
        <img src="assets/images/kiri.png" alt="Person 1" class="rounded-lg w-40 sm:w-48">
        <div class="absolute top-[-10px] right-[-10px] bg-[#FFDD00] p-2 rounded-full">
          <span class="block w-4 h-4 bg-[#FF4E00] rounded-full"></span>
        </div>
      </div>
      <!-- Person 2 -->
      <div class="relative bg-[#FFFFFF] shadow-brutal border-brutal rounded-lg p-4">
        <img src="assets/images/kanan.png" alt="Person 2" class="rounded-lg w-40 sm:w-48">
        <div class="absolute top-[-10px] right-[-10px] bg-[#333333] p-2 rounded-full">
          <span class="block w-4 h-4 bg-[#FFDD00] rounded-full"></span>
        </div>
      </div>
    </div>
  </main>

  <!-- Services Section -->
  <section id="features" class="py-12 px-6">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Utama Sawala untuk Mempermudah Diskusi dan Kolaborasi</h2>
      <p class="text-lg text-gray-700">Sawala dirancang untuk memfasilitasi diskusi yang lebih mudah dan interaktif antar pengguna, menyediakan berbagai alat untuk berbagi informasi, berbicara, dan membangun komunitas yang lebih dekat.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Web Design -->
      <a href="feedinteraktif.php" class="block w-full">
        <div class="bg-[#D7F2EE] shadow-join border-brutal rounded-xl p-6 flex flex-col items-center">
          <div class="bg-white rounded-full p-4 mb-4">
            <img src="https://placehold.co/400" alt="Feed Icon" class="w-12 h-12">
          </div>
          <h3 class="text-2xl font-semibold text-gray-900 mb-2">Feed Interaktif</h3>
          <p class="text-gray-700 text-center">Fitur feed interaktif untuk berbagi pemikiran, artikel, dan diskusi dengan komunitas yang aktif.</p>
        </div>
      </a>
      <!-- Development -->
      <a href="sharestory.php">
        <div class="bg-[#FFE8D2] shadow-join border-brutal rounded-xl p-6 flex flex-col items-center">
          <div class="bg-white rounded-full p-4 mb-4">
            <img src="https://placehold.co/400" alt="Story Icon" class="w-12 h-12">
          </div>
          <h3 class="text-2xl font-semibold text-gray-900 mb-2">Bagikan Ceritamu</h3>
          <p class="text-gray-700 text-center">Berbagi cerita pribadi dan pengalaman dalam komunitas untuk memperkaya diskusi.</p>
        </div>
      </a>
      <!-- Ecommerce -->
      <a href="chatbot.php" class="block w-full">
        <div class="bg-[#FFE8A3] shadow-join border-brutal rounded-xl p-6 flex flex-col items-center">
          <div class="bg-white rounded-full p-4 mb-4">
            <img src="https://placehold.co/400" alt="Chatbot Icon" class="w-12 h-12">
          </div>
          <h3 class="text-2xl font-semibold text-gray-900 mb-2">Chat Bot</h3>
          <p class="text-gray-700 text-center">Fitur chatbot untuk memberikan bantuan seputar pertanyaan umum dan navigasi di platform Sawala.</p>
        </div>
      </a>
    </div>
  </section>
  <!-- Services Section -->
<section id="services" class="py-12 px-6 bg-[#DFE5F2]">
  <div class="text-center mb-12">
    <h2 class="text-4xl font-bold text-gray-900 mb-4">Layanan Kami</h2>
    <p class="text-lg text-gray-700">Sawala menyediakan berbagai layanan untuk memastikan pengalaman diskusi yang nyaman dan produktif.</p>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-[#E0F7FA] shadow-join border-brutal rounded-xl p-6 text-center">
      <i class="fas fa-users text-4xl text-blue-500 mb-4"></i>
      <h3 class="text-2xl font-semibold text-gray-900 mb-2">Komunitas Aktif</h3>
      <p class="text-gray-700">Bergabunglah dalam komunitas yang aktif untuk berbagi ide dan pengalaman.</p>
    </div>
    <div class="bg-[#FFECB3] shadow-join border-brutal rounded-xl p-6 text-center">
      <i class="fas fa-comments text-4xl text-yellow-500 mb-4"></i>
      <h3 class="text-2xl font-semibold text-gray-900 mb-2">Diskusi Live</h3>
      <p class="text-gray-700">Nikmati pengalaman diskusi langsung dengan anggota komunitas lainnya.</p>
    </div>
    <div class="bg-[#F8BBD0] shadow-join border-brutal rounded-xl p-6 text-center">
      <i class="fas fa-shield-alt text-4xl text-red-500 mb-4"></i>
      <h3 class="text-2xl font-semibold text-gray-900 mb-2">Keamanan Data</h3>
      <p class="text-gray-700">Data dan privasi pengguna kami lindungi dengan standar keamanan tinggi.</p>
    </div>
  </div>
</section>


<!-- Footer -->
<?php include 'includes/footer.php'; ?>
</body>
</html>