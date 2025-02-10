<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            color: #000;
        }
    </style>
</head>
<body class="bg-white bg-[linear-gradient(to_right,#80808033_1px,transparent_1px),linear-gradient(to_bottom,#80808033_1px,transparent_1px)] bg-[size:70px_70px] font-sans items-center flex flex-col">
    <div id="loadingOverlay" style="display: none;">Loading...</div>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-[62%] flex flex-col items-center">
            <main class="container mx-auto flex flex-col items-center">
                <div class="flex flex-col space-y-4 w-[80%] max-lg:w-[100%] border-brutal shadow-brutal rounded-lg p-4 bg-[#DFE5F2] mt-42" >
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Register</h2>
                        <form id="registerForm" enctype="multipart/form-data">
                            <div class="flex flex-col space-y-4">
                                <div>
                                    <label for="username" class="text-gray-700 font-semibold">Username</label>
                                    <input type="text" id="username" name="username" class="bg-white w-full p-3 border-brutal rounded-lg shadow-brutal focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter your username" required>
                                </div>
                                <div>
                                    <label for="fullname" class="text-gray-700 font-semibold">Full name</label>
                                    <input type="text" id="fullname" name="fullname" class="bg-white w-full p-3 border-brutal rounded-lg shadow-brutal focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter your Full name" required>
                                </div>
                                <div>
                                    <label for="email" class="text-gray-700 font-semibold">Email</label>
                                    <input type="email" id="email" name="email" class="bg-white w-full p-3 border-brutal rounded-lg shadow-brutal focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter your email" required>
                                </div>
                                <div>
                                    <label for="password" class="text-gray-700 font-semibold">Password</label>
                                    <input type="password" id="password" name="password" class="bg-white w-full p-3 border-brutal rounded-lg shadow-brutal focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter your password" required>
                                </div>
                                <div>
                                    <label for="confirmPassword" class="text-gray-700 font-semibold">Confirm Password</label>
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="bg-white w-full p-3 border-brutal rounded-lg shadow-brutal focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter again your password" required>
                                </div>
                                <button type="submit" class="btn-brutal px-6 py-2 bg-[#88AAEE] text-black font-bold rounded-lg shadow-brutal hover:bg-blue-600 border-brutal">Register</button>
                            </div>
                        </form>
                        <p class="text-center mt-4 text-sm text-gray-500">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login</a></p>
                    </div>
                </div>

                <?php include '../includes/footer-feed.php'; ?>
            </main>
        </div>
    </div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault();

            const uid = document.getElementById("username").value;
            const fullname = document.getElementById("fullname").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                toastr.error("Password tidak sama!", "Kesalahan", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000
                });
                return;
            }

            // Tampilkan loading
            document.getElementById("loadingOverlay").style.display = "flex";

            axios.post("https://backend-production-c986.up.railway.app/auth/register", {
                uid: uid,
                email: email,
                password: password,
                fullname: fullname
            })
            .then(function (response) {
                toastr.success("Register berhasil!", "Sukses", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 2000
                });
                console.log(response.data);
                setTimeout(() => {
                    window.location.href = "login.php";
                }, 2000);
            })
            .catch(function (error) {
                toastr.error("Register gagal", "Error", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000
                });
                console.error(error);
            })
            .finally(function () {
                // Sembunyikan loading
                document.getElementById("loadingOverlay").style.display = "none";
            });
        });
    </script>
</body>
</html>
