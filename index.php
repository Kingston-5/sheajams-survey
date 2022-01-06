<?php

/**
 * index.php
 * intro page where the user is shown the survey intro including a brief description of sheajams
 * 
 * 1. header - included from a different file : header.inc.php
 * 
 * 2. survey intro : We are conducting this survey we wanna know how the music industry is perceived by you 
 *      and how we can make it a better place for everyone
 * 
 * 3. sheajams intro : sheajams is a art sharing platform that aimed at helping small artist grow by providing 
 *      a platform that enables them to share their art with the world.
 * 
 * 4. start button : takes the user to the first question
 * 
 * 5. footer - included from a different file : footer.inc.php
 */
?>
<div class="wrapper">
    <?php

    include "includes/header.inc.php";
    ?>

    <div class="intro">
        <h3>
            Sheajams is a online art sharing platform that is aimed at helping artists grow in their industries
            by providing a platform where they can share their work weith the world
        </h3>
        <h4 style="border-bottom: 1px solid black;">
            This survey would allow the creators of sheajams insight as to how to help the music industry grow by learning from
            both the artists and consumers
        </h4>
    </div>

    <div class="start">

        <a class="btn" href="question.php">Take Survey</a>
    </div>
    <?php

    include "includes/footer.inc.php";
    ?>
</div>