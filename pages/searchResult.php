<?php
include "../scripts/header.php";
include "../scripts/db.php";

$search = htmlspecialchars($_GET['search']);

echo '<main class="main">';
echo '<h3 class="ml-5 mt-2 border-b-1 w-75 text-3xl italic ">Sökresultat</h3>';

if(isset($_GET["search"])){
$sql = "SELECT * FROM `posts` WHERE `title`=?";
$stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($db));
        
    }
    mysqli_stmt_bind_param($stmt, "s", $search);
    if (!mysqli_stmt_execute($stmt)) {
        die("Execute failed: " . mysqli_stmt_error($stmt));
           
    }
    $result = mysqli_stmt_get_result($stmt);
    if(!$result){
        die("fetching result failed: " . mysqli_stmt_error($stmt));
    }
echo '<section class="ml-5 sm:flex sm:flex-col">';

while($row = mysqli_fetch_assoc($result)){
        $title = $row["title"];
        $price = $row["price"];
        $desc = $row["descr"];
        $startDate = $row["startDate"];
        $endDate = $row["endDate"];
        $ownerId = $row["ownerId"];
        $id = $row["id"];

        echo '
        <article class="post">
                <img class="w-1/1 h-2/3" src="/projekt/scripts/fetchImage.php?id=' . $id . '">
                <div class="m-2 text-sm text-gray-900 flex flex-col gap-1">
                    <p class="title truncate">' . $title . '</p>
                    <p class="price">' . $price . ':-</p>
                    <p class="endDate">Går ut: ' . $endDate . '</p>
                    <a class="self-center hover:underline text-blue-800" href="/projekt/pages/post.php?postId=' . $id . '">Läs mer</a>
                </div>
            </article>
        
        ';
    }
}
echo '</section>';
echo "</main>";
include "../scripts/footer.php";
?>