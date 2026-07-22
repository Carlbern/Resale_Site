<?php
$id = htmlspecialchars($_GET["id"]);
include "db.php";

$sql = "SELECT * FROM `images` WHERE `postId`=?";
$stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($db));
        
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (!mysqli_stmt_execute($stmt)) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
           
    }
    $result = mysqli_stmt_get_result($stmt);
    if(!$result){
        die("fetching result failed: " . mysqli_stmt_error($stmt));
    }

if($row = mysqli_fetch_assoc($result)){
    $filename = basename($row["name"]);
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

//Header from https://stackoverflow.com/questions/2633908/php-display-image-with-header
switch( $file_extension ) {
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpeg"; break;
    case "svg": $ctype="image/svg+xml"; break;
    default:
}

    header('Content-type: ' . $ctype);

    echo $row["data"];
    
} 

?>