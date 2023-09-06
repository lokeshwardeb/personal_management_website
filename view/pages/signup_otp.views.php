<?php

$active_class = "Submit Your Otp";
// initializing the header file
require __DIR__ . '/inc/_header.php';



?>
<!-- the main section starts here -->
    <main>

    <div class="container">
        <div class="section_title text-center m-auto mt-4 fs-2 text-primary">
        Welcome to iManage
        </div>
        <div class="section_box">

        <form action="" method="post">

        <div class="mb-4 ">

        <label for="username">Your otp </label>

        <input type="text"  name="" id="username" class="form-control">

        
        </div>

        

        
        <div class="container">
            <button class="btn btn-primary">Confirm otp</button>
        </div>

        </form>
        

        </div>
    </div>

    
    </main>

    <!-- the main section ends here -->


<?php

// initializing the footer scripts file
require __DIR__ . '/inc/_footer_scripts.php';

?>