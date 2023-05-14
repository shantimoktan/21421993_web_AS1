<?php
session_start();
// if user is not login, cant access this page
if (!isset($_SESSION['auctionUser'])) {
    header("Location: login.php");
}
$pageName = 'Edit Auctions';
include 'mainLayout.php';
if (isset($_POST['submit'])){
    $full_name = $_SESSION['auctionUser'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $deadline = $_POST['deadline'];
    $update= "UPDATE auction SET `full_name` = '$full_name', `title` = '$title', `description` = '$description', `categoryId` = '$category', `end_date` = '$deadline' WHERE id = ". $_GET['id'];
    if ($databaseConnection->query($update)){
        echo 'Auction has been updated';
    }
}
else{
    // executing data of auction to be updated
    $auctionData = $databaseConnection->prepare("SELECT * FROM auction WHERE id = ".$_GET['id']);
    $auctionData->execute();
    $auctionData = $auctionData->fetch();
?>
            <h1>Edit Auction</h1>
            <!-- form for updating auction data -->
			<form action="" method="POST">
				<label>Title</label> <input type="text" name = "title" value = "<?=$auctionData['title']; ?>" required/>
                <label>Description</label><textarea name = "description" required><?=$auctionData['description']; ?></textarea>
                <label>Category</label>
                <select name = "category">
                    <?php
                    // displaying all categories
                    foreach($categories as $category){
                        echo ' <option value = "'.$category['id'].'">'.$category['name'].'</option>';
                    }
                    ?>
                </select>
                <label>Auction Deadline</label> <input type="date" name = "deadline" value = "<?=$auctionData['end_date']?>" required/>
				<input type="submit" value="Update Auction" name = "submit"/>
			</form>
<?php
}
include 'footerLayout.php';
?>