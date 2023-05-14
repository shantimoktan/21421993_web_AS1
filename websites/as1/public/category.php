<?php
session_start();
require('databaseConnection.php');
$id = $_GET['id'];
// category execution
$ctgory = $databaseConnection->prepare('SELECT * FROM category WHERE id = ' . $id);
$ctgory->execute();
$ctgory = $ctgory->fetch();
$pageName = $ctgory['name'];
include 'mainLayout.php';

// selecting auction on basis of category
$auctions = $databaseConnection->prepare('SELECT * FROM auction WHERE categoryId = ' . $id);
$auctions->execute();
$auctions = $auctions->fetchAll();
echo '<h1>' . $ctgory['name'] . ' listing</h1>';
foreach ($auctions as $auction) {
    // executing max price of auction according to auction id
    $maxPrice = $databaseConnection->prepare('SELECT auctionId, MAX(bid) AS max_price FROM bids WHERE auctionId = ' . $auction['id']);
    $maxPrice->execute();
    $maxPrice = $maxPrice->fetch();
?>
    <ul class="productList">
        <li>
            <img src="product.png" alt="product name">
            <article>
                <!-- displaying auctions -->
                <h2><?= $auction['title'] ?></h2>
                <h3><?= $ctgory['name'] ?></h3>
                <p><?= $auction['description'] ?></p>
                <!-- displaying maximum price of auction-->
                <p class="price">Current bid: £<?= ($maxPrice['auctionId'] == $auction['id']) ? $maxPrice['max_price'] : '' ?></p>
                <?php
                // users who posted auction, can edit them
                if (isset($_SESSION['auctionUser'])) {
                    if ($_SESSION['auctionUser'] == $auction['full_name']) {
                        echo '<a href = "editAuction.php?id=' . $auction['id'] . '">Edit</a>';
                    }
                }
                ?>
                <a href="auction.php?id=<?= $auction['id'] ?>" class="more auctionLink">More &gt;&gt;</a>
            </article>
        </li>
    </ul>
<?php
}
include 'footerLayout.php';
?>