<?php
session_start();
// if admin is not login, cant access this page
if (!isset($_SESSION['auctionAdmin'])) {
    header('Location: ../login.php');
}
$pageName = 'Add Admin';
include 'mainLayout.php';
if (isset($_POST['submit'])) {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // inserting admin data in table
    $insert = "INSERT INTO admins (`full_name`, `email`, `password`) VALUES ('$fullName', '$email', sha1('$password'))";
    if ($databaseConnection->query($insert)) {
        echo 'Admin Added Successfully';
    }
} else {
?>
    <h1>Add Admin</h1>
    <!-- form for adding admin -->
    <form method="POST">
        <label>Full Name</label> <input type="text" name="full_name" required />
        <label>Email</label> <input type="email" name="email" required />
        <label>Password</label> <input type="password" name="password" required />
        <input type="submit" value="Add Admin" name="submit" />
    </form>
<?php
}
include '../footerLayout.php';
?>