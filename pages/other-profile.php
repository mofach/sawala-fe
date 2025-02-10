<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Page</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Mega:wght@100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-white bg-[linear-gradient(to_right,#80808033_1px,transparent_1px),linear-gradient(to_bottom,#80808033_1px,transparent_1px)] bg-[size:70px_70px] font-sans items-center flex flex-col">
    <div class="w-[62%] flex flex-col items-center">
        <main class="container mx-auto flex flex-col items-center">
            <?php include '../includes/header.php'; ?>
            <div class="flex flex-col space-y-4 w-[80%] max-lg:w-[100%] border-brutal shadow-brutal rounded-lg p-4 bg-[#DFE5F2]">
                <div class="flex flex-row items-center justify-between w-full mb-8">
                    <div class="flex flex-row items-center space-x-6">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-brutal shadow-brutal">
                            <img id="profile-picture" alt="Profile Picture" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col">
                        <div class="flex flex-row p-2 items-center justify-center">
                        <span id="name" class="text-black text-2xl font-bold"></span>
                        <span id="username" class="text-gray-800 text-xl ml-4"></span>
                        </div>
                        </div>
                    </div>
                </div>

                <div id="post-container" class="grid grid-cols-3 gap-4 p-4">
                    
                </div>
            </div>
            <?php include '../includes/footer-feed.php'; ?>
        </main>
    </div>

    <div id="settingsModal" class="fixed inset-0 bg-black bg-opacity-20 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <div class="flex flex-row">
            <h2 class="text-xl font-bold mb-4">Settings</h2>
            <h2 class="ml-auto hover:cursor-pointer" id="closeModal">x</h2>
            </div>
            <div class="space-y-4">
                <button class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg btn-brutal shadow-brutal border-brutal" id="editProfileButton">Edit Profile</button>
                <button class="w-full py-2 px-4 bg-yellow-500 text-white rounded-lg btn-brutal shadow-brutal border-brutal" id="changePasswordButton">Change Password</button>
                <button class="w-full py-2 px-4 bg-red-500 text-white rounded-lg btn-brutal shadow-brutal border-brutal">Logout</button>
            </div>
        </div>
    </div>

    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <h2 class="text-xl font-bold mb-4">Edit Profile</h2>
            <button class="absolute top-2 right-2 text-gray-500 close-modal hover:cursor-pointer">&times;</button>
            <form id="editProfileForm">
                <label class="block mb-2">Full name</label>
                <input id="newName" type="text" class="w-full mb-4 border p-2 rounded-lg">
                <label class="block mb-2">Profile Picture</label>
                <input id="image" type="file" class="w-full mb-4 border p-2 rounded-lg">
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg btn-brutal border-brutal shadow-brutal">Save Changes</button>
            </form>
        </div>
    </div>

    <div id="changePasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">
            <h2 class="text-xl font-bold mb-4">Change Password</h2>
            <button class="absolute top-2 right-2 text-gray-500 close-modal hover:cursor-pointer">&times;</button>
            <form id="changePasswordForm">
                <label class="block mb-2">Old Password</label>
                <input id="oldPassword" type="password" class="w-full mb-4 border p-2 rounded-lg">
                <label class="block mb-2">New Password</label>
                <input id="newPassword" type="password" class="w-full mb-4 border p-2 rounded-lg">
                <small id="passwordHelp" class="text-red-500">Password harus 6-12 karakter, mengandung 1 huruf kapital, dan 1 simbol.</small>
                <label class="block mb-2">Confirm Password</label>
                <input id="confirmPassword" type="password" class="w-full mb-4 border p-2 rounded-lg">
                <button type="submit" class="w-full py-2 px-4 bg-yellow-500 text-white rounded-lg btn-brutal border-brutal shadow-brutal">Save Password</button>
            </form>
        </div>
    </div>

    <script>
    //Get Other Profile
    document.addEventListener("DOMContentLoaded", function () {    
    const token = localStorage.getItem("token");
    if (!token) {
         window.location.href = "login.php"; // Redirect jika tidak ada token
    }
    const urlParams = new URLSearchParams(window.location.search);
    const uid = urlParams.get('uid');

    
    axios.get("https://backend-production-c986.up.railway.app/profile/" + uid,{
        headers: { Authorization: `Bearer ${token}` }
    }).then(response => {
        const profile = response.data;
        console.log(profile);
         
        // Menampilkan username
        document.getElementById("username").innerText = "@"+profile.uid;
        
        //Menampilkan fullname
        document.getElementById("name").innerText = profile.fullname;

        // Menampilkan foto profil
        const profilePic = document.getElementById("profile-picture");

        // Cek apakah profile_picture tidak null dan bukan string kosong
        if (profile.profile_picture && profile.profile_picture !== "null") {
            profilePic.src = profile.profile_picture; // Gunakan gambar dari API
        } else {
            profilePic.src = "https://www.flaticon.com/free-icon/user_149071"; // Gunakan gambar default
        }

        const postContainer = document.getElementById("post-container");

        // Cek apakah ada post
        if (profile.posts.length === 0) {
            postContainer.style.display = "none"; // Sembunyikan jika tidak ada post
        } else {
            postContainer.style.display = "grid"; // Tampilkan post dalam grid
            postContainer.innerHTML = ""; //Kosongkan sebelum diisi ulang
            
            profile.posts.forEach(post => {
    const postElement = document.createElement("div");
    postElement.classList.add("relative", "group");
    postElement.setAttribute("data-postid", post.postid); // Set ID di setiap post

    postElement.innerHTML = `
        <div class="w-full h-32 overflow-hidden rounded-lg border-brutal">
            <img src="${post.content_image ? post.content_image : 'https://via.placeholder.com/100'}" 
                 alt="Post Image" 
                 class="w-full h-full object-cover">
        </div>
    `;

    // Tambahkan event listener ke masing-masing post
    postElement.addEventListener("click", function () {
        const postid = this.getAttribute("data-postid");
        window.location.href = `detail.php?postid=${postid}`;
    });

    postContainer.appendChild(postElement); // Tambahkan post ke container
});

            
        }

    }).catch(error => {
        console.error("Failed to load", error);
    });
});
</script>
</body>
</html>