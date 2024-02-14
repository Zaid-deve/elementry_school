<?php


if (!empty($_GET['bid'])) {
    $bid = htmlentities($_GET['bid']);
    include "db/db_conn.php";
    $qry = mysqli_query($conn, "SELECT btitle title, bbody des,bbanner img,badded_at date,aname
                                FROM `blogs`
                                JOIN `admin` ON admin.aid=blogs.badded_by
                                WHERE bid = '{$bid}'");
    if ($qry) {
        if ($qry->num_rows > 0) {
            $data = mysqli_fetch_assoc($qry);
            $title = $data['title'];
            $des = $data['des'];
            $img = 'images/' . $data['img'];
            $name = $data['aname'] ?? "admin";
            $data = date("d M, Y", strtotime($data['date']));
        } else die('blog deleted or not found !');
    } else die("Something Went Wrong");
} else header("Location:news.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapKhen</title>

    <!-- remixicon cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.1.0/remixicon.css">

    <!-- stylesheets -->
    <link rel="stylesheet" href="css/config.css">
    <link rel="stylesheet" href="css/layout/header.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/layout/footer-main.css">
    <link rel="stylesheet" href="css/layout/footer-1.css">



</head>

<body>

    <!-- BODY STARTS -->
    <?php
    include "includes/layout/header.php";

    $reff = isset($_SERVER['PHP_REFERER']) ? $_SERVER['PHP_REFERER'] : "index.php";
    ?>

    <!-- SECTION 1 -->
    <section class="section section-1">
        <div class="container">
            <a href="<?php echo $reff; ?>" class="btn btn-back">&#10229;&nbsp;&nbsp;&nbsp;&nbsp;Back</a>
            <div class="section-1-banner">
                <img src="<?php echo $img; ?>" alt="#" class="section-1-banner-img">
                <div class="section-1-banner-text">
                    <h2><?php echo $title; ?></h2>
                </div>
            </div>

            <h3 class="section-1-event">TOP EVENT</h3>
            <div class="section-1-row">
                <div><img src="images/admin.png" alt="#"><strong><?php echo $name; ?></strong></div>
                <div><img src="images/clock.png" alt="#"><strong><?php echo $data; ?></strong></div>
                <div><img src="images/comments.png" alt="#"><strong>No Comments</strong></div>
            </div>
            <div class="blog-text">
                <?php echo $des; ?>
            </div>
        </div>
    </section>

    <!-- SECTION 2 -->
    <section class="section section-2">
        <div class="container">
            <h2 class="section-title">
                <strong>&bullet; Leave a reply &bullet;</strong>
            </h2>
            <p>Your email address will not be published.</p>

            <div class="section-2-form">
                <div class="section-2-form-field">
                    <input type="text" id="_name" placeholder="name" class="inp">
                    <div class="err"></div>
                </div>
                <div class="section-2-form-field">
                    <input type="text" id="_email" placeholder="email" class="inp">
                    <div class="err"></div>
                </div>
                <div class="section-2-form-field">
                    <textarea id="_des" class="inp" placeholder="Comments..."></textarea>
                    <div class="err"></div>
                </div>
                <button class="btn btn-add-comment">Post Comment</button>
            </div>
        </div>
    </section>

    <!-- JOIN US FOOTER -->
    <?php include "includes/layout/join-us.php"; ?>

    <!-- PAGE FOOTER -->
    <?php include "includes/layout/footer-main.php"; ?>

    <!-- BODY ENDS -->

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- SCRIPTS -->
    <script src="js/layout/header.js"></script>
    <script src="js/comment.js"></script>

</body>

</html>