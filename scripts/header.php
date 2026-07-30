<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylesheets/output.css">
    <script src="https://kit.fontawesome.com/b62d5348dd.js" crossorigin="anonymous"></script>
    <title>Used Wares</title>
</head>
<body class="bg-gray-50 font-jura">
    <header class="border-b-3">
        <!-- UPPER PART OF HEADER -->
        <section class="headTop grid grid-cols-3 bg-gray-400 items-center justify-around md:px-2 md:py-1">
        <!-- SEARCH BAR -->
        <form class="searchbar" action="./pages/searchResult.php" method="GET">
            <input class=" w-20 sm:w-40 md:w-50 bg-white border-1 rounded px-1" placeholder="search" type="text" name="search">
            <input class="invisible md:visible border-1 rounded-sm px-1 bg-gray-400 cursor-pointer hover:bg-gray-300" type="submit" value="search">
        </form>
        <!-- TITLE -->
        <h1 class="text-lg md:text-2xl text-center">Used Wares</h1>
        <!-- LOG IN SECTION -->
        <div class="flex flex-col w-full items-start md:justify-end md:flex-row  md:text-left">
        <!--<div class="flex flex-row justify-end">-->
            <?php
            if($_SESSION["loggedIn"]){
            echo '<p class="text-black">Logged in as: '. $_SESSION["username"] . '</p>';
            echo '<a class="hover:underline cursor-pointer text-blue-800" href="./scripts/logout.php">&nbsp;Sign out</a>';
            }
            else{
            echo '<a class="hover:underline cursor-pointer text-blue-800" href="./pages/loginPage.php">Sign in</a>';
            }
            ?>
        </div>
        </section>
        <!-- LOWER PART OF HEADER -->    
        <nav class="text-center flex flex-row justify-center items-center gap-20 bg-gray-300">
            <a class="link" href="./index.php">Home</a>
            <a class="link" href="./pages/createPost.php">Create listing</a>
        <?php
        if($_SESSION["loggedIn"]){
            echo '<a class="link" href="./pages/userPage.php">User page</a>';
        }   
        else{  
            echo '<a class="link" href="./pages/createUser.php">Registrer</a>';
        }
        ?>
        </nav>
    </header>
