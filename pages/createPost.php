<?php include "../scripts/header.php"; ?>

<?php 
if(isset($_SESSION["loggedIn"])){
echo '
<main class="main">
    <form class="border-1 flex flex-col w-75 p-5 gap-1 m-5" action="../scripts/insertPost.php" method="POST" enctype="multipart/form-data">
        <h3 class="text-2xl border-b-1 italic">Skapa annons</h3>
        <label for="title">Titel: </label>
        <input class="bg-white border-1" type="text" name="title" id="title" required>
        <br>

        <label for="title">Beskrivning: </label>
        <textarea class="bg-white border-1" name="descr" id="descr" rows="6"></textarea>
        <br>

        <label for="title">Pris: </label>
        <input class="bg-white border-1" type="number" name="price" id="price" required>
        <br>

        <label for="title">Slutdatum för annons: </label>
        <input class="bg-white border-1" type="date" name="endDate" id="endDate" required>
        <br>

        <label for="title">Bild: </label>
        <input class="bg-gray-400 border-2" type="file" name="image">
        <br>

        <input class="border-1 bg-gray-300 cursor-pointer hover:bg-gray-100" type="submit" name="submit" value="Skapa annons">

    </form>
</main>
';
}
else{
    echo '
    <main class="main">
        <p>Du behöver vara inloggad för att skapa en annons</p>
        <a class="link text-center text-blue-800" href="/~fibe008/projekt/pages/loginPage.php">Logga in</a>
    </main>
    ';

}
?>

<?php include "../scripts/footer.php"; ?>