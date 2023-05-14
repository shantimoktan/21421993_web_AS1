<?php
$pageName = 'Register';
include 'mainLayout.php';
if (isset($_POST['submit'])) {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // registering user
    $query = "INSERT INTO users (`name`, `email`, `password`) VALUES ('$fullName', '$email', sha1('$password'))";
    if ($databaseConnection->query($query)) {
        echo 'User Has Been Registered Successfully';
    }
} else {
?>
    <h1>Register</h1>
    <!-- form to register new user -->
    <form method="POST">
        <label>Full Name</label> <input type="text" name="full_name" required />
        <label>Email</label> <input type="email" name="email" required />
        <label>Password</label> <input type="password" name="password" required />
        <input type="submit" value="Register" name="submit" />
    </form>
<?php
}
include 'footerLayout.php';
?>