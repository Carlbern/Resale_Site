<?php include "../scripts/header.php"; 

if(!isset($_SESSION["loggedIn"])){
echo '    
<main class="main">

<form class="border-1 flex flex-col w-75 p-5 gap-1 m-5" action="loginPage.php" method="POST">
    <h3 class="text-2xl border-b-1 italic">Logga in</h3>

    <label for="username">Användarnamn:</label>
    <input class="bg-white border-1" type="text" name="username" id="username" required>
    <br>

    <label for="psw">Lösenord:</label>
    <input class="bg-white border-1" type="password" name="pwd" id="pwd" required>
    <br>

    <input class="border-1 bg-gray-300" type="submit" value="Logga in">
</form>
';
}
else{
        echo '<main class="main">';
        echo '<p>Inloggad som ' . $_SESSION["username"] . '</p>';
        echo '<a class="text-blue-800 hover:underline cursor:pointer" href="../index.php">Gå hem</a>';
        echo "</main>";
}
?>
<?php
include "../scripts/db.php";
    if(isset($_POST["username"])){
        $username = htmlspecialchars($_POST["username"]);
        $inputPsw = htmlspecialchars($_POST["pwd"]);


        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)){
                $psw = $row["passw"];

                if(password_verify($inputPsw, $psw)){
                    $_SESSION["loggedIn"] = true;
                    $_SESSION["username"] = $row["username"];
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["id"] = $row["id"];
                    //print header here so "logga in" button changed instantly when logged in 
                    header("Refresh:0");
                    echo '<main class="main">';
                    echo '<p>Inloggad som ' . $_SESSION["username"] . '</p>';
                    echo '<a class="text-blue-800 hover:underline cursor:pointer" href="../index.php">Gå hem</a>';
                    echo "</main>";
                }
                else{
                    echo "<script>alert('fel användarnamn eller lösenord');</script>";
                }
            }
        }


?>
</main>
<?php include "../scripts/footer.php"; ?>

