<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];

    $sql = "DELETE FROM books WHERE id='$book_id'";
    if ($conn->query($sql) === TRUE) {
        $message = "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
                        <strong class='font-bold'>Success!</strong>
                        <span class='block sm:inline'>Book deleted successfully.</span>
                    </div>";
    } else {
        $message = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                        <strong class='font-bold'>Error!</strong>
                        <span class='block sm:inline'>Error: " . $sql . "<br>" . $conn->error . "</span>
                    </div>";
    }
}

$search_query = "";
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
}

$sql = "SELECT * FROM books WHERE title LIKE '%$search_query%'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search and Delete Book</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="pt-16 container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">Search and Delete Book</h1>
        <?php if (isset($message)) echo $message; ?>
        <form method="get" action="search_delete_book.php" class="mb-4">
            <input type="text" name="query" placeholder="Search for books..." value="<?php echo htmlspecialchars($search_query); ?>" class="p-2 rounded bg-gray-200 text-gray-900 w-full md:w-1/2">
            <button type="submit" class="p-2 bg-gray-700 text-white rounded hover:bg-gray-600">Search</button>
        </form>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Book ID</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Title</th>
                    <th class="py-2 px-4 border-b-2 border-gray-300 text-left leading-tight">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='py-2 px-4 border-b border-gray-300'>" . $row['id'] . "</td>";
                        echo "<td class='py-2 px-4 border-b border-gray-300'>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td class='py-2 px-4 border-b border-gray-300'>";
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                            echo "<form method='post' action='' class='inline'>";
                            echo "<input type='hidden' name='book_id' value='" . $row['id'] . "'>";
                            echo "<button type='submit' class='p-2 bg-red-500 text-white rounded hover:bg-red-600'>Delete</button>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='py-2 px-4 border-b border-gray-300 text-center'>No books found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>