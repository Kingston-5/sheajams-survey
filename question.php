<?php

/**question.php - where the questions and their options are displayed for the user to attempt them
 * 1. header
 * 
 * 2.counter : simple counter that shows how many the questions are done and how many are left
 *      e.g 5/12
 * 3.question area : this is where the question is displayed for the user
 * 
 * 4.answer area : this is where the user will give out their answer
 * 
 * 5.control area : where the user will choose whether they wish to go to the next question or the previous one
 * 
 * 6.footer
 */

require_once 'core/init.php';
$time = time() + (1 * 24 * 60 * 60);
$db = DB::getInstance();

if ((Cookie::get('question') + 1) > Cookie::get('total_question')) {
    header("location: exit.php");
}

$db->get('questions', array('id', '>', '0'));
$questions = $db->results();

if (!Cookie::exists('total_question')) {
    Cookie::put('total_question', $db->count(), $time);
}

if ($questions[Cookie::get('question')]->type == 'A') {

    if ($questions[Cookie::get('question')]->type != Cookie::get('user_type')) {
        Cookie::put('question', (Cookie::get('question') + 1), $time);
        header("location: question.php");
    }
}

if (!empty(Input::get('next'))) {
    if (Token::check(Input::get('token'))) {

        $validate = new Validate();
        $validate->check($_POST, array(
            'option' => array(
                'name' => 'option',
                'required' => true
            ),
        ));

        if (Cookie::get('question') == '0') {
            echo 'answering question 1';
            if (Input::get('option') == 'yes') {
                $type = 'A';
            } else {
                $type = 'B';
            }
            if ($db->update('users', Cookie::get('user_id'), array(
                'type' => $type,
            ))) {
                Cookie::put('user_type', $type, $time);
            }
        }

        if ($validate->passed()) {
            if ($db->insert('responses', array(
                'user_id' => Cookie::get('user_id'),
                'question_id' => Input::get('question_id'),
                'response' => Input::get('option'),
                'date' => date('Y-m-d H:i')
            ))) {
                Cookie::put('question', (Cookie::get('question') + 1), $time);
                header("location: question.php");
            } else {
                echo 'insert failed';
            }
        } else {
            echo 'validation failed';
        }
    }
} else if (!empty(Input::get('previous'))) {
    $db->query('DELETE FROM `responses` WHERE `question_id` = ? AND user_id = ?', array(Cookie::get('question'), Cookie::get('user_id')));
    Cookie::put('question', (Cookie::get('question') - 1), $time);
    header("location: question.php");
}

?>
<div class="wrapper">
    <?php

    include "includes/header.inc.php";

    ?>

    <div class="question">
        <?php


        ?>
        <div class="counter">


            <span><?php echo Cookie::get('question') + 1 . '/' . Cookie::get('total_question'); ?></span>

        </div>
        <form action="" method="post">
            <div class="question-area">
                <?php
                echo "queston: " . $questions[Cookie::get('question')]->question;
                ?>
            </div>
            <div class="answer-area">
                <?php
                $options = json_decode($questions[Cookie::get('question')]->options);
                if (is_array($options)) {
                    foreach ($options as $option) {
                        echo '<input type="radio" name="option" value="' . $option . '" checked>' . $option . '<br>';
                    }
                }
                ?>
            </div>
            <div class="question-control">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input type="hidden" name="question_id" value="<?php echo $questions[Cookie::get('question')]->id ?>">
                <input type="submit" class="btn previous" name="previous" value="previous">

                <input type="submit" class="btn next" name="next" value="next">
            </div>
            <?php
            ?>
        </form>
    </div>
    <?php

    include "includes/footer.inc.php";
    ?>
</div>