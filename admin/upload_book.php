<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pdf = $_FILES['pdf'];

    // Check if file is a PDF
    if ($pdf['type'] != 'application/pdf') {
        echo "Only PDF files are allowed.";
        exit();
    }

    // Move the uploaded file to the uploads directory
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($pdf["name"]);

    if (move_uploaded_file($pdf["tmp_name"], $target_file)) {
        $sql = "INSERT INTO books (title, author, pdf_path) VALUES ('$title', '$author', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "Book uploaded successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Book</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-gray-700 to-gray-900 shadow-lg fixed w-full top-0 z-10">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="../index.php" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-white text-lg">Online Library</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="../index.php" class="py-4 px-2 text-white border-b-4 border-gray-500 font-semibold">Home</a>
                        <a href="../index.php#about" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">About</a>
                        <a href="../index.php#contact" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Contact</a>
                        <a href="../books/library.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Library</a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <a href="upload_book.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Upload Book</a>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['username'])): ?>
                            <a href="../user/login.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Login</a>
                            <a href="../user/register.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Register</a>
                        <?php else: ?>
                            <a href="../user/logout.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Logout</a>
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
                <li class="active"><a href="../index.php" class="block text-sm px-2 py-4 text-white bg-gray-500 font-semibold">Home</a></li>
                <li><a href="../index.php#about" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">About</a></li>
                <li><a href="../index.php#contact" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Contact</a></li>
                <li><a href="../books/library.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Library</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <li><a href="upload_book.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Upload Book</a></li>
                <?php endif; ?>
                <?php if (!isset($_SESSION['username'])): ?>
                    <li><a href="../user/login.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Login</a></li>
                    <li><a href="../user/register.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Register</a></li>
                <?php else: ?>
                    <li><a href="../user/logout.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Logout</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-16 container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">Upload Book</h1>
        <form method="post" enctype="multipart/form-data" action="">
            <label for="title" class="block mb-2">Title:</label>
            <input type="text" id="title" name="title" required class="p-2 rounded bg-gray-200 text-gray-900 w-full mb-4">
            <label for="author" class="block mb-2">Author:</label>
            <input type="text" id="author" name="author" required class="p-2 rounded bg-gray-200 text-gray-900 w-full mb-4">
            <label for="pdf" class="block mb-2">PDF:</label>
            <input type="file" id="pdf" name="pdf" accept="application/pdf" required class="p-2 rounded bg-gray-200 text-gray-900 w-full mb-4">
            <button type="submit" class="p-2 bg-gray-700 text-white rounded hover:bg-gray-600">Upload Book</button>
        </form>
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