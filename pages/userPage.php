<?php include "../scripts/header.php"; ?>

<main class="min-h-[90lvh] flex flex-col lg:flex-row justify-evenly mt-5">
    <section class="lg:w-1/5 max-h-100 p-1 border-r-1">
        <h2 class="text-4xl">
            <?php echo $_SESSION["username"] ?>
        </h2>
        <p>
            Namn: <?php echo $_SESSION["name"]; ?>
        </p>
        <p>
            Email: <?php echo $_SESSION["email"]; ?>
        </p>

    </section>    
    <section class="w-4/5 flex flex-col">
        <h3 class="text-3xl italic border-b-1 w-4/5 ml-5 md:full">Dina annonser</h3>

        <div class="grid grid-cols-1 md:gap-10 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 self-center mt-5">
            
            <?php 
            $ownerId = $_SESSION["id"];
            include "../scripts/selectPost.php"; 
            selectUserPostsEdit($ownerId);    ?>
        </div>
    </section>

</main>

<?php include "../scripts/footer.php"; ?>