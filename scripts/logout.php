<?php
session_start();
session_unset();
session_destroy();

include "header.php";
echo '<main class="main">';
   

    if(!isset($_SESSION["loggedIn"])){
            echo '<p>Loggade ut</p>';
    }
            echo '<a class="text-blue-800 hover:underline cursor:pointer" href="../index.php">Gå hem</a>';
echo '</main>';

include "footer.php" ?>