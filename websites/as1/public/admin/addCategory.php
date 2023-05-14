<?php
session_start();
// if admin is not login, cant access this page
if (!isset($_SESSION['auctionAdmin'])) {
    header('Location: ../login.php');
}
$pageName = 'Add Category';
include 'mainLayout.php';
if (isset($_POST['submit'])) {
    $categoryName = $_POST['category'];
    // insert category data in table
    $query = "INSERT INTO category (`name`) VALUES ('$categoryName')";
    if ($databaseConnection->query($query)) {
        echo 'Category Added Successfully';
    }
} else {
?>
    <h1>Add Category</h1>
    <!-- form to add category -->
    <form method="POST">
        <label>Name</label> <input type="text" name="category" required />
        <input type="submit" value="Add Category" name="submit" />
    </form>
<?php
}
include '../footerLayout.php';
?>