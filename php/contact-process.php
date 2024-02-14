
<?php


$output = 'Something Went Wrong !';
if(empty($_POST))die($output);

// get data
$name=htmlentities($_POST['name']);
$email=htmlentities($_POST['email']);
$sub=htmlentities($_POST['sub']);
$des=htmlentities($_POST['des']);

// validate data
$errors = [];

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[]="please enter a valid email address !";
}
if(empty($des))$errors[]="please describe your porpose for contacting in detail in messege box";

if(empty($errors)){

    // insert 
    include "./mailer.php";
}else echo implode("\n",$errors);

?>