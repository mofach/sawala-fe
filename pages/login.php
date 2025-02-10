<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Mega:wght@100..900&display=swap" rel="stylesheet">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        #loadingOverlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-white bg-[linear-gradient(to_right,#80808033_1px,transparent_1px),linear-gradient(to_bottom,#80808033_1px,transparent_1px)] bg-[size:70px_70px] font-sans items-center flex flex-col">
    <div id="loadingOverlay">Loading...</div>

    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-[62%] flex flex-col items-center">
            <main class="container mx-auto flex flex-col items-center">
                <div class="flex flex-col space-y-4 w-[80%] max-lg:w-[100%] border-brutal shadow-brutal rounded-lg p-4 bg-[#DFE5F2]">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Login</h2>
                        <form id="loginForm">
                            <div class="flex flex-col space-y-4">
                                <div>
                                    <label for="email" class="text-gray-700 font-semibold">Email/Username</label>
                                    <input type="email" id="email" name="email" class="bg-white w-full p-3 border-brutal rounded-lg shadow-brutal focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter your email/username" required>
                                </div>
                                <div>
                                    <label for="password" class="text-gray-700 font-semibold">Password</label>
                                    <input type="password" id="password" name="password" class="bg-white w-full p-3 border-brutal rounded-lg shadow-brutal focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter your password" required>
                                </div>
                                <button type="submit" class="btn-brutal px-6 py-2 bg-[#88AAEE] text-black font-bold rounded-lg shadow-brutal hover:bg-blue-600 border-brutal">Login</button>
                            </div>
                        </form>
                        <p class="text-center mt-4 text-sm text-gray-500">Don't have an account? <a href="register.php" class="text-blue-500 hover:underline">Sign up</a></p>
                    </div>
                </div>

                <?php include '../includes/footer-feed.php'; ?>
            </main>
        </div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const loadingOverlay = document.getElementById("loadingOverlay");

            loadingOverlay.style.display = "flex"; // Tampilkan loading

            axios.post("https://backend-production-c986.up.railway.app/auth/login", {
                email_or_uid: email,
                password: password
            })
            .then(function (response) {
                toastr.success("Login berhasil!", "Sukses", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000
                });
                
                console.log(response.data);
                localStorage.setItem("token", response.data.token);
                setTimeout(() => {
                    window.location.href = "feed.php";
                }, 2000); // Redirect setelah 2 detik
            })
            .catch(function (error) {
                toastr.error("Gagal Login. Periksa kembali email atau password!", "Error", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000
                });

                console.error(error);
            })
            .finally(function () {
                loadingOverlay.style.display = "none"; 
            });
        });
    </script>

</body>
</html>
