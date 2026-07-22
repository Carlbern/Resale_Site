<?php include "../scripts/header.php"; ?>

<main class="main">

    <form class="border-1 flex flex-col w-75 p-5 gap-1 m-5" action="" method="POST">
        <h3 class="text-2xl border-b-1 italic">Skapa konto</h3>

        <label for="name">Namn:</label>
        <input class="bg-white border-1" type="text" name="name" id="name">
        <br>

        <label for="username">Användarnamn:</label>
        <input class="bg-white border-1" type="text" name="username" id="username">
        <br>

        <label for="name">Email-adress:</label>
        <input class="bg-white border-1" type="email" name="email" id="email">
        <br>

        <label for="name">Lösenord:</label>
        <input class="bg-white border-1" type="password" name="pwd" id="pwd">
        <br>

        <label for="name">Upprepa lösenord:</label>
        <input class="bg-white border-1" type="password" name="pwd2" id="pwd2">
        <br>

        <input class="border-1 bg-gray-300" type="submit" value="Skapa konto">
    </form>

<?php 
    include "../scripts/db.php";
    if(isset($_POST["name"])
        and $_POST["name"] != ""
        and $_POST["username"] != ""
        and $_POST["email"] != ""
        and $_POST["pwd"] != ""
        and $_POST["pwd2"] != ""){

    $name = htmlspecialchars($_POST["name"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $pwd1 = htmlspecialchars($_POST["pwd"]);
    $pwd2 = htmlspecialchars($_POST["pwd2"]);

    //Checks if both passwords entered are the same
    if($_POST["pwd"] != $_POST["pwd2"]){
        echo ("Lösenorden stämmer inte överens");
    }
    else{

    //Check if username or email already exists
    $sql = "SELECT id FROM users WHERE username = ? OR email = ?";
    if ($stmt = mysqli_prepare($db, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<p>Användarnamn eller email finns redan</p>";
        mysqli_close($db);
    }

}    


    $pwd = password_hash($pwd1, PASSWORD_DEFAULT);

    //Main query
    $sql = "INSERT INTO `users`(`name`,`username`,`email`,`passw`,`id`)VALUES(?,?,?,?,NULL)";
    if(!$stmt = mysqli_prepare($db, $sql)){
        echo "error prepare";
    }
    if(!mysqli_stmt_bind_param($stmt, "ssss", $name,$username,$email,$pwd)){
        echo "error bind param";
    }
    if(!$result = mysqli_stmt_execute($stmt)){
        echo "error execute";
    }
    //Checks that query was successfull
    if($result){
        echo "<p>skapade konto</p>";
        mysqli_close($db);

    }
    else
    {
        echo "<p>fel vid skapande av konto</p>";
        mysqli_close($db);
    }
}

}
else{
    //Not all fields are filled
    if(isset($_POST["name"]))
    echo "Fel i formuläret";
}

?>
</main>



<?php include "../scripts/footer.php"; ?>