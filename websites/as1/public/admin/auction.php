<?php
session_start();
// if admin is not login, cant access this page
if (!isset($_SESSION['auctionAdmin'])) {
    header('Location: ../login.php');
}
// executing auction from provided id through url
$id = $_GET['id'];
include '../databaseConnection.php';
$auction = $databaseConnection->prepare('SELECT * FROM auction WHERE id = ' . $id);
$auction->execute();
$auction = $auction->fetch();
$pageName = $auction['title'];
include 'mainLayout.php';

// executing category data according to auction id
$category = $databaseConnection->prepare('SELECT * FROM category WHERE id = ' . $auction['categoryId']);
$category->execute();
$category = $category->fetch();

// executing max price of auction according to auction id
$maxPrice = $databaseConnection->prepare('SELECT auctionId, MAX(bid) AS max_price FROM bids WHERE auctionId = ' . $id);
$maxPrice->execute();
$maxPrice = $maxPrice->fetch();

// executing data from 'comment' table
$comments = $databaseConnection->prepare('SELECT * FROM review');
$comments->execute();
$comments = $comments->fetchAll();

// shows time remaining for auction end stackoverflow, (2014)
$currentTime = new DateTime();
$deadline = new DateTime($auction['end_date']);
$remainingTime = $deadline->diff($currentTime);

if (isset($_POST['bidAmt'])) {
    $bidAmount = $_POST['amount'];
    $query = "INSERT INTO bids (`bid`, `auctionId`) VALUES ('$bidAmount', '$id')";
    if ($databaseConnection->query($query)) {
        echo 'Bid Amount Placed Successfully';
    }
} else {
?>
    <article class="product">
        <img src="../product.png" alt="<?= $auction['title'] ?>">
        <section class="details">
            <!-- displaying auction -->
            <h2><?= $auction['title'] ?></h2>
            <h3><?= $category['name'] ?></h3>
            <p>Auction created by <?= $auction['full_name'] ?></p>
            <p class="price">Current bid: £<?= ($maxPrice['auctionId'] == $auction['id']) ? $maxPrice['max_price'] : '' ?></p>
            <?php
            // users who posted auction, can edit them
            if (isset($_SESSION['auctionUser'])) {
                if ($_SESSION['auctionUser'] == $auction['full_name']) {
                    echo '<a href = "editAuction.php?id=' . $auction['id'] . '">Edit</a>';
                }
            }
            ?>
            <!-- remaining time for auction end -->
            <time>Time left: <?php echo $remainingTime->format("%a days, %h hours, %i minutes"); ?></time>
            <!-- form for entering bid amount -->
            <form class="bid" method="POST">
                <input type="text" name="amount" required placeholder="Enter amount" />
                <input type="submit" value="Done" name="bidAmt" />
            </form>
        </section>
        <section class="description">
            <p><?= $auction['description'] ?></p>
        </section>
        <section class="reviews">
            <h2>Comments of <?= $auction['title'] ?> </h2>
            <ul>
                <?php
                // displaying all comments
                foreach ($comments as $comment) {
                    if ($comment['auctionId'] == $id) {
                        echo '<li><strong>' . $comment['full_name'] . ' commented </strong> ' . $comment['reviewText'] . ' on <em>' . $comment['date'] . '</em></li>';
                    }
                }
                ?>
            </ul>
        </section>
    </article>
<?php
}
include '../footerLayout.php';
?>