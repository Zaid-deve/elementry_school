<section class="section section-page-info">
    <div class="container">
    <?php
     // get page info
     $script = basename($_SERVER['PHP_SELF'],'.php');

        echo "<h3 class='section-page-title'>
               $script
              </h3>


       
             <ul class='breadcrumb-trail'>
                <li><a href='#'>Home</a></li>
                <li>&#10230;</li>
                <li>$script</li>
              </ul>";

        ?>


    </div>
</section>