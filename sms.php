<?php
include('connection.php');

// Retrieving the question from the user through Ajax.
$getMessage = mysqli_real_escape_string($connect, $_POST['text']);

// Comparing the user's question with those in the database.
$retrieve_data = "SELECT * FROM information";

$execute_query = mysqli_query($connect, $retrieve_data) or die("Error".mysqli_errno($this->$execute_query));


$counter = mysqli_num_rows($execute_query);

// If the user's question is found in the database, the answer will be displayed, otherwise not.
$counter = mysqli_num_rows($execute_query);
$exact_match = false;

while ($row = mysqli_fetch_array($execute_query)) {
    $question = $row['questions'];

    // Check for exact match
    if (strcasecmp($question, $getMessage) == 0) {
        $reply = $row['answers'];
        echo $reply;
        $exact_match = true;
        break;
    }

    // Check for similar match
    similar_text($question, $getMessage, $percent);

    if ($percent > 90) {
        $reply = $row['answers'];
        echo $reply;
        break;
    } elseif ($counter > 0 && $percent <= 90) {
        $counter--;

        if ($counter == 0 && $percent <= 90 && !$exact_match) {
            echo "I'm sorry, but I couldn't understand you. However, your question will be saved in my database, and I will have an answer for you soon.".'<i class="fa fa-smile-o" aria-hidden="true"></i>';

            $insert_data = "INSERT INTO `information` (`id`, `questions`, `answers`) 
                            VALUES ('', '$getMessage', 'I dont have the information at the moment, but I will answer you soon.')";        
            $execute_query = mysqli_query($connect, $insert_data);
            break;
        }
    }
}
    



?>