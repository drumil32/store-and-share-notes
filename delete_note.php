<?php

    require_once "notes_actionCRUD.php";

    if( !isset( $_GET["note_id"] ) )
        die("
                <script>
                alert('please do login first');
                location.replace('login.php');
                </script>
            ");

    $note_id = $_GET["note_id"];

    $sql = "DELETE FROM `Notes` WHERE `note_id`='$note_id' ";

    $result = mysqli_query( $conn , $sql );

    if( !$result )
        echo "  <script>
                alert('something is wrong please try again' );
                </script>";
    else
        echo "  <script>
                alert('delection is sucessfull');
                location.replace('show_notes_to_user.php');
                </script>";
                               
 ?>