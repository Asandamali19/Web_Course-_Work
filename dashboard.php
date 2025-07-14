<?php
include 'conn.php'; 


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$booksPerPage = 8;
$offset = ($page - 1) * $booksPerPage;

$sql = "SELECT * FROM book_details Order by id DESC LIMIT $booksPerPage OFFSET $offset";
$result = $conn->query($sql);

$totalBooksResult = $conn->query("SELECT COUNT(*) as total FROM book_details");
$totalBooksRow = $totalBooksResult->fetch_assoc();
$totalBooks = $totalBooksRow['total'];

// Calculate total pages
$totalPages = ceil($totalBooks / $booksPerPage);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <title>BookFriends</title>

    <script src="Dashboardscript.js"></script>

</head>
<body>
   <div class="body-wrapper">
        <div class="navigation">
            <h2>BookFriends</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search books..." onkeyup="searchBooks()">
                <button type="button">Search</button>
            </div>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="registeruser.html">Registration Form</a></li>
                <li><a href="/profile">Profile</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
        <!-- <div class="book-container">
            <div class="book-card">
                <img src="images/book1.jpg" alt="Book Title">
                <h3>Book Title 1</h3>
                <p>Author: Author Name</p>
                <p>Description: This is a brief description of the book.</p>
                <button>View Details</button>
            </div>
        </div> -->


        <div class="books-container">
            <?php if ($result->num_rows > 0): while($book = $result->fetch_assoc()): ?>
            <div class="book-card">
                <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                <p>by <?php echo htmlspecialchars($book['author']); ?></p>
                <button class="read-button"onclick="openModal(`
                <?php echo htmlspecialchars(addslashes($book['title'])); ?>`, 
                `<?php echo htmlspecialchars(addslashes($book['author'])); ?>`, 
                `<?php echo nl2br(htmlspecialchars(addslashes($book['story']))); ?>`)">Read Story</button>
                
            </div>
            
            <div id="storyModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h2 id="modalTitle"></h2>
                    <p><strong id="modalAuthor"></strong></p>
                    <div id="modalStory" class="story-text"></div>
                </div>
            </div>

            <?php endwhile; else: echo "<p>No books found.</p>"; endif; ?>

            <div id="noResults" class="no-results-message">😕 Sorry, we couldn't find any books matching your search.</div>
            
            <div class="pagination"><?php if($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a><?php endif; ?>
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" <?php if($i == $page) echo 'class="active"'; ?>>
                <?php echo $i; ?></a>
                <?php endfor; ?>
                <?php if($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
                <?php endif; ?>
                </div>

            <?php
            // Close connection
            $conn->close();
            ?>
        </div>
        

        <footer class="site-footer">
  <div class="footer-content">
    <p> 2025 WWW.BookFriends.com. All rights reserved.</p>
  </div>
</footer>
   </div>
</body>
</html>