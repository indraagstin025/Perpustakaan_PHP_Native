<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        html {
            scroll-behavior: smooth;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .fade-in {
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        .slide-in {
            animation: slideIn 1s ease-in-out;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-30px); }
            60% { transform: translateY(-15px); }
        }
        .bounce {
            animation: bounce 2s infinite;
        }
    </style>
</head>
<body class="bg-gray-100 fade-in">
    <nav class="bg-gradient-to-r from-gray-700 to-gray-900 shadow-lg slide-in fixed w-full top-0 z-10">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="index.php" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-white text-lg">Online Library</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="index.php" class="py-4 px-2 text-white border-b-4 border-gray-500 font-semibold">Home</a>
                        <a href="#about" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">About</a>
                        <a href="#contact" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Contact</a>
                        <a href="books/library.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Library</a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <a href="admin/upload_book.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Upload Book</a>
                            <a href="admin/delete_book.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Delete</a>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['username'])): ?>
                            <a href="user/login.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Login</a>
                            <a href="user/register.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Register</a>
                        <?php else: ?>
                            <a href="user/logout.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Logout</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                        <svg class=" w-6 h-6 text-white hover:text-gray-500 " x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden mobile-menu">
            <ul class="">
                <li class="active"><a href="index.php" class="block text-sm px-2 py-4 text-white bg-gray-500 font-semibold">Home</a></li>
                <li><a href="#about" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">About</a></li>
                <li><a href="#contact" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Contact</a></li>
                <li><a href="books/library.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Library</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <li><a href="admin/upload_book.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Upload Book</a></li>
                    <a href="admin/delete_book.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Delete</a>
                <?php endif; ?>
                <?php if (!isset($_SESSION['username'])): ?>
                    <li><a href="user/login.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Login</a></li>
                    <li><a href="user/register.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Register</a></li>
                <?php else: ?>
                    <li><a href="user/logout.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Logout</a></li>
                    <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="pt-16"> <!-- Add padding to avoid content being hidden behind the fixed navbar -->
        <div class="max-w-6xl mx-auto px-4 py-10 bg-cover bg-center rounded-lg shadow-lg" style="background-image: url('assets/images/Colloseum.png');">
            <h1 class="text-4xl font-bold text-center text-gray-700 bg-white bg-opacity-75 p-4 rounded bounce">Selamat Datang ke Online Library</h1>
            <p class="text-center text-gray-600 mt-4 bg-white bg-opacity-75 p-4 rounded">Online Library adalah platform yang dirancang untuk membantu Anda belajar berbagai hal dengan mudah dan menyenangkan. Kami menyediakan berbagai materi pembelajaran yang dapat diakses kapan saja dan di mana saja.</p>
            <div class="flex justify-center mt-6">
                <a href="books/library.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Kunjungi Library</a>
            </div>
        </div>
        <div id="about" class="max-w-6xl mx-auto px-4 py-10">
            <h2 class="text-3xl font-bold text-gray-700 text-center">About</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <div class="md:col-start-1 md:col-end-2">
                    <h3 class="text-2xl font-semibold text-gray-700 text-center">Kenapa Kita Ada?</h3>
                    <img src="assets/images/" alt="Gambar 1" class="mt-4 w-full md:w-auto mx-auto">
                    <p class="text-gray-600 mt-4 text-center">Online Library adalah platform yang dirancang khusus untuk membantu Anda memahami keberadaan dan tujuan hidup dengan lebih mendalam. Kami menyediakan berbagai materi pembelajaran yang tidak hanya mendalam tetapi juga interaktif, memungkinkan Anda untuk terlibat secara aktif dalam proses belajar. Dengan menggunakan pendekatan yang berbasis penelitian dan praktik terbaik, Online Library bertujuan untuk membuka wawasan baru dan memberikan pemahaman yang lebih luas tentang berbagai aspek kehidupan.</p>
                </div>
                <div class="md:col-start-2 md:col-end-3">
                    <h3 class="text-2xl font-semibold text-gray-700 text-center">Dari mana buku & jurnal berasal?</h3>
                    <img src="assets/images/" alt="Gambar 2" class="mt-4 w-full md:w-auto mx-auto">
                    <p class="text-gray-600 mt-4 text-center">Buku dan jurnal yang di upload biasanya berasal dari web web pembelajaran lain yang sudah akurat, dan untuk memastikan bahwa buku atau jurnal tersebut akurat sesuai topik yang diangkat maka kita akan lakukan pengecekan secara berulang.</p>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="contact py-32 text-white bg-gradient-to-r from-gray-700 to-gray-900" id="contact">
            <div class="container mx-auto px-4">
                <div class="contact-box">
                    <div class="box text-center">
                        <h1 class="font font-extrabold text-4xl mb-6 font-roboto text-center">
                            Contact
                        </h1>
                        <p class="font-roboto text-center">
                            You can easily send us feedback, your feedback is a compliment to
                            us.
                        </p>
                    </div>
                    <form
                        action="https://formspree.io/f/xayryzee"
                        method="post"
                        class="mt-10"
                    >
                        <table class="mx-auto lg:w-3/5 w-3/4">
                            <tr>
                                <td>
                                    <input
                                        type="text"
                                        name="Nama Lengkap"
                                        placeholder="Your Name..."
                                        autocomplete="off"
                                        required
                                        class="w-full h-12 rounded-md border bg-transparent p-3 text-white"
                                    />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input
                                        type="email"
                                        name="Email"
                                        placeholder="Your Email..."
                                        autocomplete="off"
                                        required
                                        class="w-full h-12 rounded-md bg-transparent border p-3 text-white"
                                    />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea
                                        name="Pesan"
                                        id=""
                                        cols="30"
                                        rows="10"
                                        placeholder="Message..."
                                        autocomplete="off"
                                        required
                                        class="w-full rounded-md bg-transparent border p-3 text-white"
                                    ></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button
                                        type="submit"
                                        class="w-40 h-10 bg-gray-500 ml-auto block font-bold rounded hover:bg-gray-600"
                                    >
                                        Send
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!-- Contact -->
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-10 mt-10">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center">
                <div class="flex flex-col items-start">
                    <p class="text-sm">&copy; 2024 Online Library. All rights reserved.</p>
                    <p class="text-sm">Follow us on:</p>
                    <div class="flex space-x-4 mt-2">
                        <a href="#" class="text-white hover:text-gray-500"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="#" class="text-white hover:text-gray-500"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="#" class="text-white hover:text-gray-500"><i class="fab fa-instagram"></i> Instagram</a>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-gray-500">Privacy Policy</a>
                    <a href="#" class="text-white hover:text-gray-500">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <script>
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });

        // Back to top button
        const backToTopButton = document.createElement('button');
        backToTopButton.innerHTML = '↑';
        backToTopButton.classList.add('fixed', 'bottom-4', 'right-4', 'bg-gray-700', 'text-white', 'p-2', 'rounded', 'hover:bg-gray-600', 'focus:outline-none', 'focus:shadow-outline');
        backToTopButton.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
        document.body.appendChild(backToTopButton);
    </script>
</body>
</html>