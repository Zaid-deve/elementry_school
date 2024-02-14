<?php

session_start();
session_regenerate_id();

if (!isset($_SESSION['admin_id'])) header("Location:login.php") or die("Someting Went Wrong ");
$aid = $_SESSION['admin_id'];

include "../db/db_conn.php";

$errors = [];
if (isset($_POST['submit'])) {
    $blogTitle = $_POST["blogTitle"];
    $blogBody = $_POST["blogBody"];
    $blogEvent = $_POST["blogEvent"];

    $upload_dir = '../images/';
    $fname = basename($_FILES['blogImage']['name']);
    $upload_file = $upload_dir . $fname;
    $upload_file_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));

    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');

    if (!in_array($upload_file_type, $allowed_types)) {
        $errors[] = "Invalid file type. Please upload a JPEG, PNG, or GIF file.";
    } else {
        if (move_uploaded_file($_FILES['blogImage']['tmp_name'], $upload_file)) {
            $res = mysqli_query($conn, "INSERT INTO blogs (`btitle`, `bbody`, `bevent`, `bbanner`,`badded_by`)
                                      VALUES (" . json_encode($blogTitle) . ", " . json_encode($blogBody) . ", '{$blogEvent}', '{$fname}','1')");
            if (!$res) $errors[] = 'Failed To Add Blog';
            else header("Location: dashboard.php");

            exit();
        } else {
            $errors[] = "Error uploading the file.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        @import url(../css/config.css);
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(rgba(0,0,0,.7),rgba(0,0,0,.5)),url(https://i.pinimg.com/originals/e2/4f/fb/e24ffbced22f79e61ac7c1aadb7975df.jpg) center no-repeat;
            background-size: cover;
        }

        .dashboard-container {
            display: flex;
            max-width: 1600px;
            background: #fff;
        }

        h2 {
            margin-bottom: 22px;
            color: #6662e2;
            text-decoration:underline 4px #eee;
        }

        .left-panel,
        .right-panel {
            flex: 1;
            padding: 20px;
        }

        form {
            display: grid;
            gap: 16px;
        }

        form :where(input, textarea) {
            padding: 12px;
            outline: none;
            background :#f4f4f4;
            border: none;
            border-radius: 9px;
        }

        input[type=file]{
            background: transparent;
            border: 1px solid #ccc;
        }
        label {
            font-weight: 600;
            font-style: italic;
            color: #42455a;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        form button {
            padding: 12px 50px;
            background: #6662e2;
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-weight: 600;
            display: block;
            margin-left: auto;
            border-radius: 9px;
        }

        table {
            width: 100%;
            background: #f8f8f8;
        }
        table tr td {
            border: 1px solid #ccc;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .blog-card {
            background: #f8f8f8;
            border-radius: 9px;
            overflow: hidden;
        }

        .blog-img {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
        }

        .blog-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 9px;
        }

        .blog-actions a {
            font-weight: 700;
            font-size: 17px;
            color: #888888;
            text-decoration: underline 2px;
        }

        .blog-card-body {
            padding: 16px 12px;
            line-height: 20px;
            display: grid;
            gap: 9px;
        }

        @media (max-width:768px) {
            .dashboard-container {
                flex-direction: column;
            }
        }

        @media (max-width:560px) {
            .blog-grid{
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="left-panel">
            <h2>Add Blog</h2>
            <?php

            if (!empty($errors)) {
                echo "<div>
                        <strong>";
                implode("<br>", $errors);
                "</strong>
                     </div>";
            }

            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <label for="blogTitle">Title:</label>
                <input type="text" id="blogTitle" name="blogTitle" required>

                <label for="blogBody">Body:</label>
                <textarea id="blogBody" name="blogBody" rows="4" required></textarea>

                <label for="blogEvent">Event:</label>
                <input type="text" id="blogEvent" name="blogEvent" required>

                <label for="blogImage">Image:</label>
                <input type="file" id="blogImage" name="blogImage" accept="image/*" required>

                <button type="submit" name="submit">Add Blog</button>
            </form>
        </div>

        <div class="right-panel">
            <h2>Comments on Blogs: </h2>
            <?php
            $result = mysqli_query($conn, "SELECT cname name,cemail email,cdes message,cbid,cdate  FROM comments ORDER BY cid DESC LIMIT 3");

            if (mysqli_num_rows($result) > 0) {
                echo "<table cellspacing='7' cellpadding='5'>";
                echo "<tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['message']}</td>";
                    echo "<td>{$row['cdate']}</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No comments to show on blog !.";
            }

            echo "<br><br>
                  <h2>All Blogs:</h2>
                  <div class='blog-grid'>";

            $qry = mysqli_query($conn, "SELECT bid,bbanner img,btitle title,aname FROM blogs JOIN admin ON blogs.badded_by = admin.aid LIMIT 10");

            if ($qry && mysqli_num_rows($qry) > 0) {
                while ($data = mysqli_fetch_assoc($qry)) {
                    echo "<div class='blog-card'>
                             <img src='../images/{$data['img']}' alt='Blog 1' class='blog-img'>
                             <div class='blog-card-body'>
                                 <h5>".substr($data['title'],0,50)."...</h5>
                                 <p>Added by: {$data['aname']}</p>
                                 <div class='blog-actions'>
                                     <a href='edit.php?bid={$data['bid']}'>Edit</a>
                                     <a href='delete.php?bid={$data['bid']}'>Delete</a>
                                 </div>
                             </div>
                         </div>";
                }
            }else echo"No Blogs Yet !";
            echo "</div>";

            ?>



        </div>
</body>

</html>