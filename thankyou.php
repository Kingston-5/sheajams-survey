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

    if ($questions[Cookie::get('question')]->type == 'A' && Cookie::get('user_type') == 'B') {
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
            ),
            'text' => array(
                'name' => 'text',
                'min' => 2,
                'max' => 50
            ),
        ));

        if (Cookie::get('question') == '0') {
            $type = '';
            if (Input::get('option') == 'Yes') {
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

        $input = array(
            "option" => empty(Input::get('option')) ? null : Input::get('option'),
            "extra" => empty(Input::get('text')) ? null : Input::get('text')
        );

        $input = json_encode($input);
        
        if ($validate->passed()) {
            if ($db->insert('responses', array(
                'user_id' => Cookie::get('user_id'),
                'question_id' => Input::get('question_id'),
                'response' => $input,
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
<div class="intro">
  <h1>Thank You for taking part in our survey, We really appreciate it<br/>❤❤❤</h1>
  </div>
    <?php

    include "includes/footer.inc.php";
    ?>
</div>
