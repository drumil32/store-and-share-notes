<?php

    require_once "notes_actionCRUD.php";    

    if( !isset( $_GET["title"] ) || !isset( $_SESSION['TO12'] ) )
        die("
                <script>
                alert('please hey do login first');
                location.replace('login.php');
                </script>
            ");

    $title = $_GET["title"];
    $TO12 = $_SESSION['TO12'];
    $sno = $_SESSION['sno']; //it use to delete a request after share a note

    $sql = "SELECT * FROM `Notes` WHERE `user_id`='$ID' AND `title`='$title'";

    $result = mysqli_query( $conn , $sql );

    if( !$result )
    die("
            <script>
            alert('something is wrong please try again');
            location.replace('show_notes_to_user.php');
            </script>
        ");


    $row = mysqli_fetch_assoc( $result );

    $description = $row['description'];

    $sql = "INSERT INTO `shared_notes` (`sheare_id`, `TO12`, `FROM12`, `title`, `description`, `date`) VALUES (NULL, '$TO12', '$ID', '$title','$description', CURRENT_TIMESTAMP );";

    $result = mysqli_query( $conn , $sql );

    if( !$result )
        die("
                <script>
                alert('something is wrong please try again');
                location.replace('show_request_message.php'); 
                </script>
            ");
                    // here we must give sno in location.replace but how!!!!!!!


    $sql = "DELETE FROM `request` WHERE `request`.`sno` = '$sno';";

    $result  = mysqli_query( $conn , $sql );


    if( !$result )
    {

        die("
                <script>
                alert('Due to some server issuse note shared successfully but request can't deleted');
                location.replace('show_request.php');
                </script>
            ");
    }


    echo "
            <script>
            alert('Note shared successfully');
            location.replace('show_requests.php');
            </script>
         ";


?>