<?php include "scripts/header.php" ?>
    <main class="flex flex-col min-h-[90lvh]">
        <?php include "scripts/selectPost.php"; 
           echo '
            <h3 class="ml-5 mt-2 border-b-1 w-75 text-3xl italic ">Listings</h3>
            <section class="index-section">';
              selectAllPosts(); 
        ?>
        </section>



    </main>
<?php include "scripts/footer.php" ?>
