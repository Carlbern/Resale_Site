<?php
include "header.php";
include "db.php";

if(isset($_POST["title"])){
$maxImageSize = 4 * 1024 * 1024;
    //Error handling
    if($_FILES["image"]["size"] > $maxImageSize){
        die("Filen är för stor, maxstorlek $maxImageSize MB <br><a class='link text-blue-800' href='../pages/createPost.php'>Gå tillbaka</a>");
    }

    $title = htmlspecialchars($_POST["title"]);
    $descr = htmlspecialchars($_POST["descr"]);
    $price = htmlspecialchars($_POST["price"]);
    $startDate = date("Y-m-d");
    $endDate = htmlspecialchars($_POST["endDate"]);
    $ownerId = $_SESSION["id"];
    $postId = NULL;

    $sql = "INSERT INTO `posts` (`title`, `price`, `descr`, `startDate`, `endDate`, `ownerId`) VALUES (?, ?, ?, ?, ?, ?)"
        or die("query error");
    $stmt = mysqli_prepare($db, $sql)
        or die("prepare error");
    mysqli_stmt_bind_param($stmt, "sisssi", $title, $price, $descr, $startDate, $endDate, $ownerId)
        or die("param error");
    mysqli_stmt_execute($stmt)
        or die("execution error");

    $postId = mysqli_insert_id($db);

    //Uploading of post image
    $imageName = htmlspecialchars($_FILES["image"]["name"]);
    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
    $imageType = htmlspecialchars($_FILES["image"]["type"]);
    
    //Check if file is image
    if(substr($imageType, 0, 5) == "image"){

    //Prepare statement
    $sql = "INSERT INTO `images` (`name`, `postId`, `data`) 
    VALUES (?,?,?)";

    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt,"sss",$imageName,$postId,$imageData);
    mysqli_stmt_execute($stmt);

    echo "<main class='main'>Listing created! <br>
        <a class='link text-center text-blue-800' href='../index.php'>Home</a>
          </main  ";

    }
}


?>