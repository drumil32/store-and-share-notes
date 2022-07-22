<?php

    session_start();
    require_once "notes_actionCRUD.php";

    if( !isset($_GET['sno']) )
        die("
                <script>
                alert('You are trying to dirctly come here Please do login first yar!!');
                location.replace('login.php');
                </script>
            ");
            
    $sno = $_GET['sno'];


    $sql = "SELECT * FROM `request` WHERE `sno`='$sno'";

    $result = mysqli_query( $conn , $sql );

    if( !$result )
        die("
                <script>
                alert('Some thing is wrong Please try again');
                location.replace('show_requests.php');
                </script>
            ");
    
    $row = mysqli_fetch_assoc( $result );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

    <div style="border:2px solid black;"><?php echo $row['text']; ?></div>
    <?php
        if( isset($_SESSION['send']) ) //it is only a signal by which we come to know from where user come here from which web page because this file is use in  two ways 1.show_requests.php 2.show_sent_requsets.php
        {
            echo "<a href='show_requests.php'>Back</a>";

            // die(var_dump($_GET['TO12']));
            $_SESSION['TO12'] = $_GET['TO12'];

            echo "<a href="."show_notes_to_user.php?sno=$sno".">Give Note</a>";
        }
        else
            echo "<a href='show_sent_requests.php'>Back</a>";
    ?>
    <a href="delete_request.php?sno=<?php echo $sno; ?>">Delete Request</a>
</body>
</html>