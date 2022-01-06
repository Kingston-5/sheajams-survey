<?php

/**exit.php
 * 
 * last part of the survey where the user is asked to give their name email and
 * shown a thank you message to indicate the survey is over
 * 
 */
?>
<div class="wrapper">
    <?php

    include "includes/header.inc.php";
    ?>
    <div class="intro">
    <h3>
        thank you for taking part in our survey .we really appreciate it
    </h3>
    <h4>
        Please leave your name and email so we can bring you more updates on our project
    </h4>
    </div>
    <form class="form" action="#" method="post">
        <label for="Name">
            Name
        </label>
        <input type="text" class="text" placeholder="Your name">
        <label for="email">
            Email
        </label>
        <input type="email" class="text" placeholder="Your Email">
        <input type="submit" class="submit btn">
    </form>
    <?php

    include "includes/footer.inc.php";
    ?>
</div>