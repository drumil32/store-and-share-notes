<?php

session_start();
require_once "notes_actionCRUD.php";

if (isset($_SESSION['send'])) {
    unset($_SESSION['send']);
}

if (isset($_SESSION['TO12'])) {
    unset($_SESSION['TO12']);
}

if (isset($_SESSION['sno'])) {
    unset($_SESSION['sno']);
}

if (isset($_SESSION['FROM12'])) {
    unset($_SESSION['FROM12']);
}

if (isset($_SESSION['TO12'])) {
    unset($_SESSION['TO12']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="user_home_page.php">Back</a></li>
        <li><a href="show_sent_requests.php">Sent Requests</a></li>
        <li><a href="show_other_people.php">Send Request</a></li>
        <li><a href="show_requests.php">Show Requests</a></li>
        <li><a href="show_shared_people_name_to_user.php">Show taken Notes</a></li>   <!-- show notes which is given to user by other user-->
        <li><a href="show_shared_people_name_to_user.php?given=1">Show given Notes</a></li>   <!-- show notes which given by user to other user -->
        <li><a href="login.php">Logout</a></li>
    </ul>
</body>
</html>
