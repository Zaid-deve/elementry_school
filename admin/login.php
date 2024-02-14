<?php
$errors = [];

if (isset($_POST['submit'])) {
    include "../db/db_conn.php";

    $username = mysqli_real_escape_string($conn, htmlentities($_POST['username']));
    $password = mysqli_real_escape_string($conn, htmlentities($_POST['password']));

    if (empty($username) || empty($password)) {
        $errors[] = "every field is required";
    } else {
        $qry = mysqli_query($conn, "SELECT aid FROM admin WHERE aemail='{$username}' AND apass='{$password}'");
        if ($qry) {
            if (mysqli_num_rows($qry) > 0) {
                $admin = mysqli_fetch_assoc($qry);
                session_start();
                $_SESSION['admin_id']=$admin['aid'];
                header("Location:dashboard.php") or die();
            } else $errors[]='invalid email or password';
        } else $errors[] = "Something Went Wrong !";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <center class="login-container">
        <h2>Admin Login</h2>
        <div>
            <h6 style="color:orangered">
                <?php
                if (!empty($errors)) {
                    echo implode("<br>", $errors);
                }
                ?>
            </h6>
        </div>
        <br> <br>
        <form action="#" method="post">
            <label for="username">Email   :</label>
            <input type="text" id="username" name="username" required> <br> <br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required> <br> <br>

            <button type="submit" name="submit">Login</button>
        </form>
    </center>
</body>

</html>