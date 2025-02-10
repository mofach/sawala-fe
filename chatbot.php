<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Bot - Sawala</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Mega:wght@100..900&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-[#FFE8A3] text-[#1A1A1A] font-sans">
  <header class="flex flex-wrap justify-between items-center p-6 bg-[#FFE8A3] sticky top-0 z-50">
    <div class="text-3xl font-bold text-[#1A1A1A]">Sawala</div>
    <a href="pages/login.php" class="px-4 py-2 mt-4 sm:mt-0 bg-[#1A1A1A] text-[#FFFFFF] rounded-xl font-bold hover:bg-[#333333]">
      Login here
    </a>
  </header>

  <main class="p-6 max-w-4xl mx-auto flex flex-col lg:flex-row">
    <!-- Left Section -->
    <div class="flex flex-col lg:w-1/2 lg:pr-6 mb-6 lg:mb-0">
      <h1 class="text-4xl font-bold mb-6">Chat Bot</h1>
      <!-- <img src="https://placehold.co/600x400" alt="Chat Bot" class="rounded-lg shadow-brutal mb-6 w-6/12 lg:w-full"> -->
      <img src="assets/images/chatbot-ai.png" alt="Chat Bot" class="rounded-lg shadow-brutal mb-6 w-6/12 lg:w-full">
    </div>
    <!-- Right Section -->
    <div class="flex flex-col lg:w-1/2 lg:pl-6">
      <p class="text-lg text-gray-800 mb-4">
        Fitur Chat Bot di Sawala dirancang untuk memberikan bantuan seputar pertanyaan umum dan navigasi di platform. Chat Bot kami siap membantu Anda menemukan informasi yang Anda butuhkan dengan cepat dan mudah.
      </p>
      <p class="text-lg text-gray-800">
        Dengan Chat Bot, Anda dapat mengajukan pertanyaan tentang fitur, layanan, dan cara penggunaan Sawala. Ayo mulai berinteraksi dengan Chat Bot kami dan dapatkan bantuan yang Anda butuhkan!
      </p>
    </div>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>
</html>