<?php
session_start();
// if admin is not login, cant access this page
if (!isset($_SESSION['auctionAdmin'])) {
    header('Location: ../login.php');
}
$pageName = 'Admins';
include 'mainLayout.php';

// executing data from admins
$admins = $databaseConnection->prepare('SELECT * FROM admins');
$admins->execute();
$admins = $admins->fetchAll();
?>
<a style="float:right; font-size:20px; padding: 20px;" href='addAdmin.php'>Add New Admin</a>
<h1>All Admins</h1>
<?php
foreach ($admins as $admin) {
?>
    <ul class="productList">
        <li>
            <article>
                <!-- displaying admin data -->
                <h2><?= $admin['full_name'] ?></h2>
                <p><?= $admin['email'] ?></p>
                <?php
                // preventing admin from deleting themself
                if (isset($_SESSION['auctionAdmin'])) {
                    if ($admin['full_name'] != $_SESSION['auctionAdmin']) {
                ?>
                        <a href="deleteAdmin.php?id=<?=$admin['id'] ?>">Delete</a>
                <?php
                    }
                }
                ?>
            </article>
        </li>
    </ul>
    <hr />
<?php
}
include '../footerLayout.php';
?>