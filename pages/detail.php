<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Page</title>
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
<div class="w-[62%] flex flex-col items-center">
    <main class="container mx-auto flex flex-col items-center">
            <?php include '../includes/header.php'; ?>
            <div id="feed-container" class="w-full space-y-4"></div>
            <div class="w-[80%] max-lg:w-[100%] mx-auto mb-6 p-6 bg-[#E3E8F2] border-brutal shadow-brutal rounded-lg">
                <h4 class="text-xl font-bold mb-4">Comments</h4>
                <div id="comment-container" class="w-full space-y-4"></div>
                
                <form id="chatForm" class="mt-4">
                    <div class="flex flex-row space-x-4 max-sm:flex-col mb-2">
                        <input id="message" name="message" class="w-full p-3 border-brutal rounded-lg shadow-brutal focus:ring-2 focus:ring-blue-400 focus:outline-none resize-none" placeholder="Type your comment..." rows="2" required></input>
                        <button type="submit" class="btn-brutal px-6 py-2 bg-[#88AAEE] text-black font-bold rounded-lg shadow-brutal hover:bg-blue-600 border-brutal max-sm:mt-3">Send</button>
                    </div>
                </form>
            </div>
            <?php include '../includes/footer-feed.php'; ?>
        </main>
    </div>
    <script>
    const token = localStorage.getItem("token");
    if (!token) {
        window.location.href = "login.php"; 
    }
    
    const urlParams = new URLSearchParams(window.location.search);
    const postid = urlParams.get('postid');
    const feedContainer = document.getElementById('feed-container');
    const commentContainer = document.getElementById('comment-container');
    const loadingOverlay = document.getElementById("loadingOverlay");
    loadingOverlay.style.display = "flex"; // Tampilkan loading

    document.getElementById("chatForm").addEventListener("submit", function(event) {
        event.preventDefault();
        const comment = document.getElementById("message").value;
        
        axios.post("https://backend-production-c986.up.railway.app/feed/" + postid + "/comment",{ content: comment }, 
        {
             headers: {
                "Authorization": `Bearer ${token}`
            }
        })
        .then(function (response) {
            toastr.success("Komentar Berhasil Dibuat", "Sukses", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 1000
            });
            setTimeout(() => {
            window.location.reload();
                    }, 2000);
            console.log(response.data);
        })
        .catch(function (response) {
            toastr.error("Gagal menambahkan komentar", "Error", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000
            });
            console.error(response.error);
        })
        .finally(function () {
                loadingOverlay.style.display = "none"; // Sembunyikan loading setelah selesai
        });

    })

    axios.get("https://backend-production-c986.up.railway.app/feeds/" + postid, {
        headers: {
            "Authorization": `Bearer ${token}`
        }
    })
    .then(function (response) {
        console.log(response.data);
        const post = response.data;
        const detail = createDetail(post);
        feedContainer.appendChild(detail);

        const comments = response.data.comments;
        comments.forEach(comment => {
            const commentElement = createCommentElement(comment);
            commentContainer.appendChild(commentElement);
        })
    })
    .catch(function (error) {
        console.error(error);
    })
    .finally(function () {
                loadingOverlay.style.display = "none"; // Sembunyikan loading setelah selesai
});

    function createCommentElement(comment) {
        const commentContainer = document.createElement('div');
        commentContainer.innerHTML = `
        <div class="comment flex items-start space-x-4 mb-4 bg-[#E3E0F3] rounded-lg p-3 border-brutal shadow-brutal">
        <img src="${comment.profile_picture}" alt="User Avatar" class="w-10 h-10 rounded-md border-brutal shadow-brutal">
            <div class="comment-content flex-1">
                <div class="flex flex-column items-center">
                    <h5 class="font-bold">${comment.fullname}</h5>
                    <p>@${comment.uid}</p>
                    <p class="ml-auto text-sm">${new Date(comment.created_at).toLocaleString()}</p>
                </div>

                <p class="text-gray-800">${comment.content}<p>
            </div>
        </div>
        
        `;
        return commentContainer;
        
    }

    function createDetail(post) {
    const postContainer = document.createElement('div');
    postContainer.innerHTML = `
    <div class="w-[80%] max-lg:w-[100%] mx-auto mb-6 p-6 bg-[#DFE5F2] border-brutal shadow-brutal rounded-lg">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="${post.profile_picture}" alt="User Avatar" class="w-10 h-10 rounded-md border-brutal shadow-brutal">
                <div>
                    <div class="flex items-center space-x-2">
                        <h3 class="font-bold text-gray-900">${post.fullname}</h3>
                        <p class="text-sm">@${post.uid}</p>
                        <p class="text-sm text-gray-600">${new Date(post.created_at).toLocaleString()}</p>
                    </div>
                </div>
            </div>
            
            <button class="settingsButton px-4 py-2 bg-[#88AAEE] hover:bg-blue-600 text-black rounded-lg shadow-brutal btn-brutal border-brutal">
                ...
            </button>
        </div>

        <div class="mt-4">
            <p class="text-gray-800 text-lg">${post.content_text}</p>
        </div>

        <div class="mt-4 flex flex-col items-center">
            <img src="${post.content_image}" alt="Post Image" class="w-[90vh] border-brutal rounded-lg">
            <div class="w-[100%]">
                <div class="flex flex-row mt-2">
                    <p class="ml-10 text-gray-800 text-sm">${post.comment_count} comments</p>
                </div>
            </div>
        </div>
    </div>
    `;

    setTimeout(() => {
        const settingsButton = postContainer.querySelector(".settingsButton");
        
        settingsButton.addEventListener("click", function() {
            openSettingsModal(post, postContainer);
        });
    }, 0);

    return postContainer;
}

function openSettingsModal(post, postContainer) {
    const modal = document.createElement("div");
    modal.classList.add("fixed", "inset-0", "bg-black", "bg-opacity-20", "flex", "justify-center", "items-center");
    modal.innerHTML = `
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold">Settings</h2>
                <h2 class="hover:cursor-pointer text-lg font-bold" id="closeModal">×</h2>
            </div>
            <div class="space-y-4 mt-4">
                <button class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg btn-brutal shadow-brutal border-brutal" id="editPostButton">Edit</button>
                <button class="w-full py-2 px-4 bg-red-500 text-white rounded-lg btn-brutal shadow-brutal border-brutal" id="deletePostButton">Delete</button>
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    document.getElementById("closeModal").addEventListener("click", function() {
        modal.remove();
    });

    document.getElementById("editPostButton").addEventListener("click", function() {
        modal.remove();
        openEditModal(post, postContainer);
    });

    document.getElementById("deletePostButton").addEventListener("click", function() {
        if(confirm("apakah ingin menghapus postingan ini?")) {
            deletePost(post.id, postContainer);
            modal.remove();
        }
        modal.remove();
    });
}

function openEditModal(post, postContainer) {
    const modal = document.createElement("div");
    modal.classList.add("fixed", "inset-0", "bg-black", "bg-opacity-20", "flex", "justify-center", "items-center");
    modal.innerHTML = `
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold">Edit Post</h2>
            
            <textarea id="editContent" class="w-full mt-2 p-2 border rounded-md">${post.content_text}</textarea>
            
            <input type="file" id="editImage" class="w-full mt-2 p-2 border rounded-md" accept="image/*">
            
            <div class="flex justify-end space-x-2 mt-4">
                <button id="cancelEdit" class="px-4 py-2 bg-gray-400 text-white rounded-lg">Cancel</button>
                <button id="saveEdit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Save</button>
            </div>
        </div>

    `;
    
    document.body.appendChild(modal);
    
    document.getElementById("cancelEdit").addEventListener("click", function() {
        modal.remove();
    });
    
    document.getElementById("saveEdit").addEventListener("click", function() {const token = localStorage.getItem("token");
    if (!token) {
        window.location.href = "login.php"; 
    }
    
        const urlParams = new URLSearchParams(window.location.search);
        const postid = urlParams.get('postid');
        const updatedText = document.getElementById("editContent").value;
        const imageInput = document.getElementById("editImage");
        const formData = new FormData();
    
        formData.append("contentText", updatedText);
        if (imageInput.files.length > 0) {
            formData.append("imageFiles", imageInput.files[0]); 
        }
        axios.patch("https://backend-production-c986.up.railway.app/feeds/" + postid, formData, 
        {
             headers: {
                "Authorization": `Bearer ${token}`
            }
        })
        .then(function (response) {
            toastr.success("Edit feed sukses!", "Sukses", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 2000
            });
            console.log(response.data);
            setTimeout(() => {
            window.location.reload();
            }, 2000);
        })
        .catch(function (response) {
            toastr.error("Edit feed gagal", "Error", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000
            });
            console.error(response.error);
        })
        
        modal.remove();
    });
}
    function deletePost(postId, postContainer) {
        axios.delete("https://backend-production-c986.up.railway.app/feeds/" + postid, 
        {
             headers: {
                "Authorization": `Bearer ${token}`
            }
        })
        .then(function (response) {
            toastr.success("Delete feed sukses", "Sukses", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 1000
            });
            setTimeout(() => {
            window.location.href = "profile.php";
                }, 2000);
            console.log(response.data);
        })
        .catch(function (response) {
            toastr.error("Delete feed gagal", "Error", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000
            });
            console.error(response.error);
        })
        
        modal.remove();
        postContainer.remove();
    }


    </script>
</body>
</html>
