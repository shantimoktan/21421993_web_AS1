<?php
session_start();
// if user is not login, cant access this page
if (!isset($_SESSION['auctionUser'])) {
    header("Location: login.php");
}
$pageName = 'Add Auctions';
include 'mainLayout.php';
if (isset($_POST['submit'])) {
    $full_name = $_SESSION['auctionUser'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $deadline = $_POST['deadline'];
    // inserting auctions data in table
    $insert = "INSERT INTO `auction` (`full_name`, `title`, `description`, `categoryId`, `end_date`) VALUES ('$full_name', '$title', '$description', '$category', '$deadline')";
    if ($databaseConnection->query($insert)) {
        echo '<p>Auction Added</p>';
    }
} else {
?>
    <h1>Add Auction</h1>
    <!-- form to add auction -->
    <form method="POST">
        <label>Title</label> <input type="text" name="title" required />
        <label>Description</label><textarea name="description" required></textarea>
        <label>Category</label>
        <select name="category">
            <?php
            // displaying all categories 
            foreach ($categories as $category) {
                echo ' <option value = "' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            ?>
        </select>
        <label>Auction Deadline</label> <input type="date" name="deadline" required />
        <input type="submit" value="Add Auction" name="submit" />
    </form>
<?php
}
include 'footerLayout.php';
?>