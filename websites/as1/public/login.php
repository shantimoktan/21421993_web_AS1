<?php
session_start();
$wrong = false;
$pageName = 'Log In';
include 'mainLayout.php';
if (isset($_POST['login'])) {

    // executing all data of users of ibuy auction
    $allUsers = $databaseConnection->prepare('SELECT * FROM users');
    $allUsers->execute();
    $allUsers = $allUsers->fetchAll();

    // executing all data of admins of ibuy auction
    $allAdmins = $databaseConnection->prepare('SELECT * FROM admins');
    $allAdmins->execute();
    $admins = $allAdmins->fetchAll();
    foreach ($admins as $admin) {
        // if email and password of admin gets matched with database, they are logged in to auction page
        if ($admin['email'] == $_POST['email'] && $admin['password'] == sha1($_POST['password'])) {
            $_SESSION['auctionAdmin'] = $admin['full_name'];
            echo '<script>alert("Admin Logged In Successfully");
            window.location.href = "admin/index.php";</script>';
        }
        else{
            $wrong = true;
        }
    }
    foreach ($allUsers as $user) {
        // if email and password of user gets matched with database, they are logged in to auction page
        if ($user['email'] == $_POST['email'] && $user['password'] == sha1($_POST['password'])) {
            $_SESSION['auctionUser'] = $user['name'];
            echo '<script>alert("Logged In Successfully");
            window.location.href = "index.php";</script>';
        }
        else{
            $wrong = true;
        }
    }
}
if($wrong){
    echo '<script>alert("Invalid Credentials");</script>';
}
?>
<h1>Log In</h1>
<!-- login form -->
<form method="POST">
    <!-- for writing email -->
    <label>Email</label> <input type="email" name="email" required />
    <!-- for writing password -->
    <label>Password</label> <input type="password" name="password" required />
    <input type="submit" value="Log In" name="login" />
</form>
<?php
include 'footerLayout.php';
?>