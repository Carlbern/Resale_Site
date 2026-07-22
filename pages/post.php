<?php
include "../scripts/header.php";
include "../scripts/db.php";
$postId = htmlspecialchars($_GET["postId"]);

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
    $title = $row["title"];
    $price = $row["price"];
    $descr = $row["descr"];
    $startDate = $row["startDate"];
    $endDate = $row["endDate"];
    $ownerId = $row["ownerId"];
    $id = $row["id"];

    $sql = "SELECT * FROM `users` WHERE `id`=$ownerId";
    $result = mysqli_query($db, $sql);
    $ownerName = null;
    while($rowOwner = mysqli_fetch_assoc($result)){
        $ownerName = $rowOwner["username"];
    }

echo "
        <main class='grid grid-cols-5 grid-rows-1 border-1 p-10 min-h-[90lvh]'>
            <img class='grid-span-1 col-start-1 w-full' src='../scripts/fetchImage.php?id=$id'></img>
            <section class='border-l-1 flex flex-col p-5 gap-5 grid-span-4 col-start-3 col-span-3'>
                <h3 class='text-3xl'>$title</h3>
                <p>$descr</p>
                <p>$price :-</p>
                <div class='border-1 w-75'>
                <p>Postat datum: $startDate</p>
                ";
                //Post has expired
                if(date("Y-m-d") > $endDate){
                    echo "<p class='text-red-500'>Går ut: $endDate</p>";
                }
                else{
                    echo "<p>Går ut: $endDate</p>";
                }
                
                echo
                "
                <p>Postad av: $ownerName </p>  
                </div>
            </section>
        </main>

";
}


include "../scripts/footer.php";
?>