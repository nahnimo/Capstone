<?php
session_start();
include './connection.php';
include './session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neust Chatbot</title>
    <link rel="stylesheet" href="stylesheet.css">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>



</head>

<body>

    <div class="wrapper">
        <div class="title">NEUST FAQ Chatbot</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon"><i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <?php
                    $hour = date('H');
                    $greet = ($hour >= 18) ? "Good Evening" : (($hour >= 12) ? "Good Afternoon" : "Good Morning");
                    ?>
                    <p>
                        <?php echo $greet ?>, how can I help you?
                    </p>

                </div>
            </div>
        </div>

        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" name="text" placeholder="type text here....." required>
                <button id="send-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>

    </div>

    <div class="logout">
        <a href="?logout=1">Logout</a>
    </div>
    <script>

        $(document).ready(function () {

            $("#send-btn").on("click", function () {
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + $value + '</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');


                $.ajax({

                    url: 'sms.php',
                    type: 'POST',
                    data: 'text=' + $value,
                    success: function (result) {

                        $reply = '<div class="bot-index inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>' + result + '</p></div></div>';
                        $(".form").append($reply);

                        // When the chat reaches the end, the scrollbar goes directly to the bottom of the chat.
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
</body>
<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

</html>