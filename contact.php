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
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/layout/footer-main.css">
</head>

<body>

    <!-- BODY STARTS -->
    <?php include "includes/layout/header.php"; ?>

    <!-- ABOUT US STARTS -->

    <?php include "includes/layout/page-info-header.php" ?>

    <!-- SECTION 1 -->
    <section class="section section-1">
        <div class="container">
            <div class="section-1-grid">
                <div class="section-1-grid-1">
                    <h2 class="section-title">&bullet; Contact Info &bullet;</h2>
                    <div class="section-grid-1-items">
                        <div class="row row-1">
                            <img src="images/phone.png" alt="#">
                            <div class="row-body">
                                <h3>Call us directly on </h3>
                                <p>+234 805 029 1265 <br>
                                    +234 907 228 0656</p>
                            </div>
                        </div>

                        <div class="row row-2">
                            <img src="images/mail.png" alt="#">
                            <div class="row-body">
                                <h3>Mail us directly on</h3>
                                <p>Info20@gmail.com <br>
                                    Info21@gmail.com</p>
                            </div>
                        </div>

                        <div class="row row-3">
                            <img src="images/location.png" alt="#">
                            <div class="row-body">
                                <h3>Find us </h3>
                                <p>4 law castle agbole aro opp. fidelity bank omida, abeokuta.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-1-grid-2">
                    <h2 class="section-title">&bullet; Get in Touch &bullet;</h2>
                    <div class="section-grid-2-form">
                        <div class="section-1-field">
                            <input type="text" placeholder="name" id="_name" class="inp">
                            <div class="err"></div>
                        </div>
                        <div class="section-1-field">
                            <input type="text" placeholder="Email" id="_email" class="inp">
                            <div class="err"></div>
                        </div>
                        <div class="section-1-field">
                            <input type="text" placeholder="Subject" id="_sub" class="inp">
                            <div class="err"></div>
                        </div>
                        <div class="section-1-field">
                            <textarea id="_des" class="inp" placeholder="Mesaage here..."></textarea>
                            <div class="err"></div>
                        </div>

                        <button class="btn btn-submit">Send message</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2 -->
    <section class="section section-2">
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d186568.99219170626!2d71.69776066024696!3d22.415882449999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sin!4v1707489543888!5m2!1sen!2sin" height="450" style="border:0;width:100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- PAGE FOOTER -->
    <?php include "includes/layout/footer-main.php"; ?>

    <!-- BODY ENDS -->

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- SCRIPTS -->
    <script src="js/layout/header.js"></script>
    <script src="js/contact.js"></script>

</body>

</html>