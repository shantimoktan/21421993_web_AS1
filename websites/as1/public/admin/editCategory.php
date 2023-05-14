<?php
session_start();
// if admin is not login, cant access this page
if (!isset($_SESSION['auctionAdmin'])) {
    header('Location: ../login.php');
}
$pageName = 'Edit Categories';
include 'mainLayout.php';
if (isset($_POST['submit'])) {
    $category_name = $_POST['category'];
    // category update
    $update = "UPDATE category SET `name` = '$category_name' WHERE id = " . $_GET['id'];
    if ($databaseConnection->query($update)) {
        echo 'Category Updated';
    }
} else {
    // executing data of category to be updated
    $ctgoory = $databaseConnection->prepare("SELECT * FROM category WHERE id = " . $_GET['id']);
    $ctgoory->execute();
    $ctgoory = $ctgoory->fetch();
?>
    <h1>Edit Category</h1>
    <!-- form to update category -->
    <form method="POST">
        <label>Name</label> <input type="text" name="category" value="<?= $ctgoory['name']; ?>" required />
        <input type="submit" value="Update Category" name="submit" />
    </form>
<?php
}
include '../footerLayout.php';
?>