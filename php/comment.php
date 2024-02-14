<?php

if (!empty($_POST)) {
    include "../db/db_conn.php";
    $name = mysqli_real_escape_string($conn, htmlentities($_POST['name']));
    $email = mysqli_real_escape_string($conn, htmlentities($_POST['email']));
    $cmt = mysqli_real_escape_string($conn, htmlentities($_POST['cmt']));
    $bid = mysqli_real_escape_string($conn, htmlentities($_POST['bid']));

    // validate
    $errors = "";
    if (empty($name)) {
        $errors[] = "name cannot be empty";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email address !";
    if (empty($cmt)) $errors[] = "comment cannot be empty";
    if (empty($bid)) die("Something Went Wrong !");

    $qry = mysqli_query($conn, "INSERT INTO comments (cname,cemail,cdes,cbid) VALUES ('{$name}','{$email}','{$cmt}', '{$bid}')");
    if ($qry) echo "success";
    else echo "Failed to Add Comment !";
}
