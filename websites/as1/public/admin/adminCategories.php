<?php
session_start();
// if admin is not login, cant access this page
if (!isset($_SESSION['auctionAdmin'])) {
    header('Location: ../login.php');
}
$pageName = 'Categories';
include 'mainLayout.php';
?>
<a style="float:right; font-size:20px; padding: 20px;" href='addCategory.php'>Add New Category</a>
<h1>All Categories</h1>
<?php
foreach ($category as $categories) {
?>
    <ul class="productList">

        <li>
            <article>
                <!-- displaying category data -->
                <h2><?= $categories['name'] ?></h2>
                <!-- editing category link -->
                <p><a href="editCategory.php?id=<?=$categories['id'] ?>">Edit</a></p>
                <!-- deleting category link -->
                <p><a href="deleteCategory.php?id=<?=$categories['id'] ?>">Delete</a></p>
            </article>
        </li>
    </ul>
    <hr />
<?php
}
include '../footerLayout.php';
?>