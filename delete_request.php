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

    $sql = "DELETE FROM `request` WHERE `sno`='$sno';";

    $result = mysqli_query( $conn , $sql );

    if( !$result )
    {
        die("
                <script>
                alert('Some thing is wrong Please try again');
                location.replace('user_account.php');
                </script>
            ");
    }
    if( isset($_SESSION['send']) )
    {
        echo "
                <script>
                alert('Deletion is sucessfull');
                location.replace('show_requests.php');
                </script>            
             ";
    }
    else
    {
        echo "
                <script>
                alert('Deletion is sucessfull');
                location.replace('show_sent_requests.php');
                </script>            
            ";
    }

?>