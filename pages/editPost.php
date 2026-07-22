<?php 
include "../scripts/header.php";
include "../scripts/db.php";

echo '
        <main class="main">

        <form class="border-1 flex flex-col w-75 p-5 gap-1 m-5" action="" method="POST" enctype="multipart/form-data">
        <h3 class="text-2xl border-b-1 italic">Edit listing</h3>
        <label for="title">Title: </label>
        <input class="bg-white border-1" type="text" name="title" id="title" maxlength="30">
        <br>

        <label for="title">Description: </label>
        <textarea class="bg-white border-1" name="descr" id="descr" rows="6"></textarea>
        <br>

        <label for="title">Price: </label>
        <input class="bg-white border-1" type="number" name="price" id="price" >
        <br>

        <label for="title">Expiration date for listing: </label>
        <input class="bg-white border-1" type="date" name="endDate" id="endDate">
        <br>

        <label for="title">Image: </label>
        <input class="bg-gray-400 border-2" type="file" name="image">
        <br>

        <input class="border-1 bg-gray-300 cursor-pointer hover:bg-gray-100" type="submit" name="submit" value="Update listing">
        </form>

        <form class="flex flex-col w-75 gap-1" action="" method="POST">
            <label for="confirm">Enter "DELETE" to permanently delete</label>
            <input class="bg-white border-1" type="text" name="confirm">
            <input class="border-1 bg-red-700 cursor-pointer hover:bg-red-500" type="submit" name="delete" value="DELETE LISTING">
        </form>
';

if(isset($_POST["submit"])){
    $postId = htmlspecialchars($_GET["postId"]);

    $sql = "SELECT * FROM `posts` WHERE `id`=$postId";
    $result = mysqli_query($db, $sql);

    while($row = mysqli_fetch_assoc($result)){

        //Check that right owner is changing
        if($_SESSION["id"] == $row["ownerId"]){
          
            if($_POST["title"] != ""){
                    $sql = "UPDATE `posts` SET `title`=? WHERE `id`=?";
                    $stmt = mysqli_prepare($db, $sql);
                    mysqli_stmt_bind_param($stmt, "si", $_POST["title"], $postId);
                    mysqli_stmt_execute($stmt);
            }

            if($_POST["descr"] != ""){
                    $sql = "UPDATE `posts` SET `descr`=? WHERE `id`=?";
                    $stmt = mysqli_prepare($db, $sql);
                    mysqli_stmt_bind_param($stmt, "si", $_POST["descr"], $postId);
                    mysqli_stmt_execute($stmt);
            }

            if($_POST["price"] != ""){
                    $sql = "UPDATE `posts` SET `price`=? WHERE `id`=?";
                    $stmt = mysqli_prepare($db, $sql);
                    mysqli_stmt_bind_param($stmt, "ii", $_POST["price"], $postId);
                    mysqli_stmt_execute($stmt);
            }

            if($_POST["endDate"] != ""){
                    $sql = "UPDATE `posts` SET `endDate`=? WHERE `id`=?";
                    $stmt = mysqli_prepare($db, $sql);
                    mysqli_stmt_bind_param($stmt, "si", $_POST["endDate"], $postId);
                    mysqli_stmt_execute($stmt);
            }

            if($_FILES["image"]["name"] != ""){
                    $imageName = htmlspecialchars($_FILES["image"]["name"]);
                    $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
                    $imageType = htmlspecialchars($_FILES["image"]["type"]);

                    $sql = "SELECT * FROM `images` WHERE `postId`= $postId";
                    $result = mysqli_query($db,$sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $sql = "UPDATE `images` SET `data`=?,`name`=? WHERE `postId`=?";
                        $stmt = mysqli_prepare($db, $sql);
                        mysqli_stmt_bind_param($stmt, "ssi", $imageData, $imageName, $postId);
                        mysqli_stmt_execute($stmt);
                    }
            }
            

            echo '<p class="text-green-500 mt-2">Information uppdaterad</p>';
        } 
        else{
            echo '<p class="text-red-500 mt-2">Felaktig eller ingen användare</p>';
        }


    }
}
if(isset($_POST["delete"])){
    if($_POST["confirm"] == "DELETE"){
        $postId = htmlspecialchars($_GET["postId"]);
        $ownerId = $_SESSION["id"];

        $sql = "SELECT * FROM `posts` WHERE `id`=?";
        $stmt = mysqli_prepare($db, $sql);
        if (!$stmt) {
            die("Prepare failed: " . mysqli_error($db));
}
        mysqli_stmt_bind_param($stmt, "i", $postId);
        if (!mysqli_stmt_execute($stmt)) {
           die("Execute failed: " . mysqli_stmt_error($stmt));
}
        $result = mysqli_stmt_get_result($stmt);
        if(!$result){
                die("fetching result failed: " . mysqli_stmt_error($stmt));
        }

        while($row = mysqli_fetch_assoc($result)){
            if($row["ownerId"] == $ownerId){
            //Deleted post
            $sql = "DELETE FROM `posts` WHERE `id`=?";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, "i", $postId);
            mysqli_stmt_execute($stmt);

            //Deleted image
            $sql = "DELETE FROM `images` WHERE `postId`=?";
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, "i", $postId);
            mysqli_stmt_execute($stmt);

            echo "<script>alert('" . $row["title"] . " raderad')</script>";           
        }
            else{
                echo "Du har inte rättigheter att ta bort";
            }
        }
    }
    
}




    echo "</main>";
include "../scripts/footer.php"; ?>