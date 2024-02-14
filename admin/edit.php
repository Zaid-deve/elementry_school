

<?php 

if(!isset($_GET['bid']))die('Something Went Wrong !');
$bid = $_GET['bid'];

session_start();
if(!isset($_SESSION['admin_id']))header("Location:login.php?r=edit&bid=$bid");

include "../db/db_conn.php";
$qry = mysqli_query($conn, "SELECT btitle title,bbanner img,bbody des,bevent ev FROM blogs WHERE bid = '{$bid}'");
if(!$qry || !mysqli_num_rows($qry))die("blog deleted or not found !");

$data = mysqli_fetch_assoc($qry);
$title = $data['title'];
$event = $data['ev'];
$des = $data['des'];
$img = $data['img'];

// Handle form submission
$error=[];
if(isset($_POST['submit'])){
    $btitle= htmlentities($_POST['blogTilte']);
    $bdes= htmlentities($_POST['blogBody']);
    $bevent= htmlentities($_POST['blogEvent']);
    $nimg = $_FILES['blogImage'];
    $newimage = $img;

    if($nimg['error']==UPLOAD_ERR_OK){
        $path = "../images/";
        $fname = basename($nimg['name']);
        $uploadDir = $path.$fname;
        $ftype = strtolower(pathinfo($nimg['name'],PATHINFO_EXTENSION));
        if(in_array($ftype,["jpg","png",'jpeg'])){
            if(!move_uploaded_file($nimg['tmp_name'],$uploadDir)){
                $error[]='Failed To Change Image';
            }else $newimage=$uploadDir;
        }
    }

    if(empty($error)){
        $qry = mysqli_query($conn, "UPDATE blogs SET btitle = '{$title}',bbody = '{$bdes}',bevent = '{$bevent}',bbanner='{$newimage}' WHERE bid = '$bid'");
        if($qry)header("Location: dashboard.php");
        else $error[]="failed to change blog !";
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .container {
            margin: auto;
            max-width: 768px;
            width: 100%;
            padding: 20px;
        }

        form {
            display: grid;
            gap: 16px;
        }

        form :where(input, textarea) {
            padding: 12px;
            outline: none;
            border: 1px solid #888888;
        }

        form textarea{
            resize: vertical;
            min-height: 130px;
        }

        label {
            margin-bottom: 5px;
            font-weight: 700;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        form button {
            padding: 12px;
            background: dodgerblue;
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-weight: 600;
        }

        #currentImage{
            max-width: 320px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit My Blog</h2>
        <?php
        if(!empty($error)){
            echo "<div>
                     <h4>
                         ".implode('<br>',$error)."
                     </h4>
                 </div>";
        }
        ?>
        
        <form action="#" method="post" enctype="multipart/form-data">
            <label for="blogTitle">Title:</label>
            <input type="text" id="blogTitle" name="blogTitle" required value="<?php echo $title ?>">

            <label for="blogBody">Body:</label>
            <textarea id="blogBody" name="blogBody" required ><?php echo $des ?></textarea>

            <label for="blogEvent">Event:</label>
            <input type="text" id="blogEvent" name="blogEvent" required value="<?php echo $event ?>">

            <label>Current Image:</label>
            <img src="../images/<?php echo $data['img']; ?>" alt="Current Image" id="currentImage">
            <label for="blogImage">Add New Image:</label>
            <input type="file" id="blogImage" name="blogImage" accept="image/*">

            <button type="submit" name="submit">edit blog</button>
        </form>
    </div>

    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $("document").ready(function() {
            let change = false;
            $("form input,form textarea").change(function(){
                change=true
            })
            $("#blogImage").change(function(e){
                if(e.target.files.length > 0){
                    let type = e.target.files[0].type.slice(e.target.files[0].type.lastIndexOf('/')+1)
                    
                    if(['png','jpeg','jpg'].includes(type)){
                        $("#currentImage").attr("src",URL.createObjectURL(e.target.files[0]))
                    }else alert("Unsupported file type")
                }
            })
            $("form").submit(function(e){
                if(!change)e.preventDefault()
            })
        })
    </script>
</body>

</html>