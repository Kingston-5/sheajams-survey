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
    require_once 'core/init.php';
    include "includes/header.inc.php";
    
    $db = DB::getInstance();

    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
    
            $validate = new Validate();
            $validate->check($_POST, array(
                'name' => array(
                    'name' => 'name',
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ),
                'email' => array(
                    'name' => 'email',
                    'required' => true,
                    'max' => 50
                ),
            ));
    
            if ($validate->passed()) {
               $update = $db->update('users', Cookie::get('user_id'), array(
                    'name' => Input::get('name'),
                    'email' => Input::get('email')
                ));
                var_dump($update);
                exit();
                if(){
                    header("location: thankyou.php");
                }
            }
        }
    }

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
        <input type="text" class="text" name='name' placeholder="Your name">
        <label for="email">
            Email
        </label>
        <input type="email" class="text" name='email' placeholder="Your Email">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="submit btn">
    </form>
    <?php

    include "includes/footer.inc.php";
    ?>
</div>
