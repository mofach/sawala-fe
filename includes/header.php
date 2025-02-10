<?php
$current_page = basename($_SERVER['REQUEST_URI']);
?>

<nav class="bg-[#DFE5F2] border-brutal shadow-brutal p-4 w-[80%] max-lg:w-[100%] my-5 rounded-md ">
    <div class="max-w-5xl mx-auto flex justify-between items-center">
        <a href="#" class="text-xl font-bold text-gray-900 text-sm">Sawala</a>
        <ul class="hidden lg:flex space-x-6 text-lg text-gray-800">
            <li>
                <a href="feed.php" 
                   class="hover:text-blue-500 <?php echo $current_page == 'feed.php' ? 'border-2 border-black rounded-md' : ''; ?> p-2 text-sm">
                    Home
                </a>
            </li>
            <li>
                <a href="chatbot.php" 
                   class="hover:text-blue-500 <?php echo $current_page == 'chatbot.php' ? 'border-2 border-black rounded-md' : ''; ?> p-2 text-sm">
                    Chatbot
                </a>
            </li>
            <li>
                <a href="profile.php" 
                   class="hover:text-blue-500 <?php echo $current_page == 'profile.php' ? 'border-2 border-black rounded-md' : ''; ?> p-2 text-sm">
                    Profile
                </a>
            </li>
        </ul>
        <div class="relative lg:hidden">
            <button id="dropdownButton" class="text-gray-800 focus:outline-none">
    
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div id="dropdownMenu" class="absolute right-0 mt-2 w-40 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                <ul class="py-1 text-sm text-gray-800">
                    <li>
                        <a href="feed.php" 
                           class="block px-4 py-2 hover:bg-gray-200 <?php echo $current_page == 'feed.php' ? 'font-bold' : ''; ?>">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="chatbot.php" 
                           class="block px-4 py-2 hover:bg-gray-200 <?php echo $current_page == 'chatbot.php' ? 'font-bold' : ''; ?>">
                            Chatbot
                        </a>
                    </li>
                    <li>
                        <a href="profile.php" 
                           class="block px-4 py-2 hover:bg-gray-200 <?php echo $current_page == 'profile.php' ? 'font-bold' : ''; ?>">
                            Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>