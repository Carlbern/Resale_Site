<?php
function selectAllPosts(){
include "db.php";
    $sql = "SELECT * FROM `posts`";
    $result = mysqli_query($db,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $title = $row["title"];
        $price = $row["price"];
        $endDate = $row["endDate"];
        $id = $row["id"];

        if(date("Y-m-d") < $endDate){
        echo '
        <article class="post">
                <img class="w-1/1 h-2/3" src="/projekt/scripts/fetchImage.php?id=' . $id . '">
                <div class="m-2 text-sm text-gray-900 flex flex-col gap-1">
                    <p class="title truncate">' . $title . '</p>
                    <p class="price">' . $price . ':-</p>
                    <p class="endDate">Expires: ' . $endDate . '</p>
                    <a class="self-center hover:underline text-blue-800" href="/projekt/pages/post.php?postId=' . $id . '">More</a>
                </div>
        </article>
        
        ';
        }
    }
}
function selectUserPosts($ownerId){
include "db.php";
    $sql = "SELECT * FROM `posts` WHERE `ownerId` = ?";
    $stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($db));
        
    }
    mysqli_stmt_bind_param($stmt, "i", $ownerId);
    if (!mysqli_stmt_execute($stmt)) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
           
    }
    $result = mysqli_stmt_get_result($stmt);
    if(!$result){
        die("fetching result failed: " . mysqli_stmt_error($stmt));
    }

    while($row = mysqli_fetch_assoc($result)){
        $title = $row["title"];
        $price = $row["price"];
        $desc = $row["descr"];
        $startDate = $row["startDate"];
        $endDate = $row["endDate"];
        $ownerId = $row["ownerId"];
        $id = $row["id"];

        echo '
        <article class="post relative ">                
                <img class=" w-1/1 h-2/3" src="/projekt/scripts/fetchImage.php?id=' . $id . '" alt="No image for produkt">
                 <div class="m-2 text-sm text-gray-900 flex flex-col gap-1">
                    <p class="title truncate">' . $title . '</p>
                    <p class="price">' . $price . ':-</p>
                    ';
                    if(date("Y-m-d") < $endDate){
                        echo "<p class='text-black'>Expires: " . $endDate . "</p>";
                    }
                    else{
                        echo "<p class='text-red-500'>Expires: " . $endDate . "</p>";
                    }
    
                    echo '
                    <a class="self-center hover:underline text-blue-800" href="/projekt/pages/post.php?postId=' . $id . '">More</a>
                </div>
            </article>
        ';

    }
}
function selectUserPostsEdit($ownerId){
include "db.php";
    $sql = "SELECT * FROM `posts` WHERE `ownerId` = ?";
    $stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($db));
        
    }
    mysqli_stmt_bind_param($stmt, "i", $ownerId);
    if (!mysqli_stmt_execute($stmt)) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
           
    }
    $result = mysqli_stmt_get_result($stmt);
    if(!$result){
        die("fetching result failed: " . mysqli_stmt_error($stmt));
    }

    while($row = mysqli_fetch_assoc($result)){
        $title = $row["title"];
        $price = $row["price"];
        $desc = $row["descr"];
        $startDate = $row["startDate"];
        $endDate = $row["endDate"];
        $ownerId = $row["ownerId"];
        $id = $row["id"];

        echo '
        <article class="post relative ">
                <a href="editPost.php?postId=' . $id . '"><i class="fa-solid fa-pen-to-square absolute text-lg text-orange-800 -top-2 -left-2 "></i></a>
                <img class=" w-1/1 h-2/3" src="/projekt/scripts/fetchImage.php?id=' . $id . '">
                 <div class="m-2 text-sm text-gray-900 flex flex-col gap-1">
                    <p class="title truncate">' . $title . '</p>
                    <p class="price">' . $price . ':-</p>
                    ';
                    if(date("Y-m-d") < $endDate){
                        echo "<p class='text-black'>Expires: " . $endDate . "</p>";
                    }
                    else{
                        echo "<p class='text-red-500'>Expires: " . $endDate . "</p>";
                    }
    
                    echo '
                    <a class="self-center hover:underline text-blue-800" href="/projekt/pages/post.php?postId=' . $id . '">More</a>
                </div>
            </article>
        
        ';
    }
}
?>