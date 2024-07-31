<?php
include('../includes/db.php');

$book_id = $_GET['id'];
$sql = "SELECT * FROM books WHERE id='$book_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
} else {
    echo "Book not found";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $book['title']; ?></title>
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
                        <a href="library.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Library</a>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <a href="../admin/upload_book.php" class="py-4 px-2 text-white font-semibold hover:text-gray-500 transition duration-300">Upload Book</a>
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
                <li><a href="library.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Library</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <li><a href="../admin/upload_book.php" class="block text-sm px-2 py-4 hover:bg-gray-500 transition duration-300">Upload Book</a></li>
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
        <h1 class="text-4xl font-bold mb-4"><?php echo $book['title']; ?></h1>
        <h2 class="text-2xl mb-4">by <?php echo $book['author']; ?></h2>
        <embed src="<?php echo $book['pdf_path']; ?>" type="application/pdf" width="100%" height="600px" class="animate__animated animate__fadeIn" />
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