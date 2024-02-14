<?php


$to = "yuo.tuber2019@gmail.com";
$headers = [];
$headers[] = "MIME-Version:1.0";
$headers[] = "Content-Type:text/html;charset=UTF-8";
$headers[] = "From: RapKhen <zaidpatel121121@gmail.com>";
$headers[] = "Reply-To: $name < $email>";
$headers[] = "To:$to";

$msg_body="<div style='font-size:20px;'>
              <h1 style='color:dodgerblue;'>New Contact Email Added</h1><br><br>
              From: <strong>$email as $name</strong><br><br>
              To: <strong>$to</strong><br><br>
              Messege: <strong>$des</strong><br><br>
           </div>";

if (mail($to, $sub ?: 'new contact mail rapkhen', $msg_body, implode("\r\n",$headers))) {
    echo "success";
} else echo $output;

?>