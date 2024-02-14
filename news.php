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
    <link rel="stylesheet" href="css/layout/page-info-header.css">
    <link rel="stylesheet" href="css/news.css">
    <link rel="stylesheet" href="css/layout/footer-main.css">



</head>

<body>

    <!-- BODY STARTS -->
    <?php include "includes/layout/header.php"; ?>

    <!-- ABOUT US STARTS -->

    <?php include "includes/layout/page-info-header.php" ?>


    <!-- SECTION - 1  -->
    <section class="section section-1">
        <div class="container">
            <div class="section-1-grid">

                <?php

                include "db/db_conn.php";
                $qry = mysqli_query($conn, "SELECT bid, bbanner img,btitle title,bbody des,admin.aname name,badded_at date FROM blogs RIGHT JOIN admin on admin.aid = blogs.badded_by ORDER BY bid DESC LIMIT 15");
                if ($qry && mysqli_num_rows($qry) > 0) {
                    $rows = mysqli_fetch_assoc($qry);
                    echo "<div class='section-1-grid-item'>
                              <div class='section-1-grid-banner'>
                                  <img src='images/{$rows['img']}' alt='#' class='section-1-grid-img'>
                                  <div class='section-1-banner-text'>
                                      <h3>".  substr($rows['title'],0,80) . "</h3>
                                      <p>".  substr($rows['des'],0,80) . "</p>
                                  </div>
                              </div>
          
                              <div class='section-1-body'>
                                  <div class='section-1-body-title'>Recent Event</div>
                                  <div class='section-1-body-row'>
                                      <strong><img src='images/admin.png' alt='#'> Admin</strong>
                                      <strong><img src='images/clock.png' alt='#'>" . date("M D,Y", strtotime($rows['date'])) . "</strong>
                                      <strong><img src='images/comments.png' alt='#'> No Comments</strong>
                                  </div>
                                  <p>{$rows['des']}</p>
                                  <a href='blog.php?bid={$rows['bid']}' class='btn btn-fill'>Read more &nbsp;-></a>
                              </div>
                         </div>";


                    if ($rows = mysqli_fetch_assoc($qry)) {
                        echo "<div class='section-1-grid-item'>
                                  <div class='section-1-grid-banner'>
                                      <img src='images/{$rows['img']}' alt='#' class='section-1-grid-img'>
                                      <div class='section-1-banner-text'>
                                          <h3>{$rows['title']}</h3>
                                      </div>
                                  </div>
              
                                  <div class='section-1-body'>
                                      <div class='section-1-body-title'>Recent Event</div>
                                      <p>{$rows['des']}</p>
                                      <a href='blog.php?bid={$rows['bid']}' class='btn btn-text'>Readmore >>></a>
                                  </div>
                              </div>";
                    }

                    if ($rows = mysqli_fetch_assoc($qry)) {
                        echo "<div class='section-1-grid-item'>
                                  <div class='section-1-grid-banner'>
                                      <img src='images/{$rows['img']}' alt='#' class='section-1-grid-img'>
                                      <div class='section-1-banner-text'>
                                          <h3>{$rows['title']}</h3>
                                      </div>
                                  </div>
              
                                  <div class='section-1-body'>
                                      <div class='section-1-body-title'>Recent Event</div>
                                      <p>" . substr($rows['des'], 0, 30) . "</p>
                                      <a href='blog.php?bid={$rows['bid']}' class='btn btn-text'>Readmore >>></a>
                                  </div>
                              </div>";
                    }
                } else echo "<h1>Nothing Display Right Now !</h1>"

                ?>
            </div>
        </div>
    </section>

    <section class="section section-2">
        <div class="container">
            <h2 class="section-title">
                <strong> &bullet; LatesT News & Event &bullet;</strong>
            </h2>

            <div class="section-2-grid">
                <?php

                while ($rows = mysqli_fetch_assoc($qry)) {
                    echo "<div class='section-2-grid-col'>
                              <div class='section-2-col-img'>
                                  <img src='images/{$rows['img']}' alt='#'>
                              </div>
          
                              <div class='section-2-col-body'>
                                  <p>" . substr($rows['des'], 0, 30) . "</p>
                                  <div class='section-2-col-row-1'><strong>".date("M d,Y",strtotime($rows['date'])) . ' by ' . $rows['name'] ."</strong></div>
                                  <div class='section-2-col-row-2'>
                                      <strong><img src='images/comments.png' alt='#'>&nbsp; 31</strong>
                                      <a href='blog.php?bid={$rows['bid']}' class='btn'>Read More >>></a>
                                  </div>
                              </div>
                          </div>";
                }


                ?>

            </div>
        </div>
    </section>

    <!-- PAGE FOOTER -->
    <?php include "includes/layout/footer-main.php"; ?>

    <!-- BODY ENDS -->

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- SCRIPTS -->
    <script src="js/layout/header.js"></script>
    <script src="js/news.js"></script>

</body>

</html>