<?php
    
    require_once "notes_actionCRUD.php";

    if( !isset( $_GET["title"] ) && !isset($_GET['note_id']) )
        die("
                <script>
                alert('please do login first');
                location.replace('login.php');
                </script>
            ");

    if( isset($_GET['title']) )
        $title = $_GET["title"];
    else
        $note_id = $_GET['note_id'];

    if( !isset($_SESSION['FROM12']) && !isset($_SESSION['TO12']) )
    {

        $sql = "SELECT * FROM `Notes` WHERE `note_id`='$note_id' ";

        $result = mysqli_query( $conn , $sql );

        echo "<a href='show_notes_to_user.php'>Back</a>";
    }
    else
    {

        // modify this part 

        if( isset($_SESSION['FROM12']) )
        {
            $other_ID = $_SESSION['FROM12'];
            
            $p2 = "TO12";
            $p1 = "FROM12";
        }
        elseif( isset($_SESSION['TO12']) )
        {
            $other_ID = $_SESSION['TO12'];
            
                $p1 = "TO12";
                $p2 = "FROM12";
        }
        else
            die("
                    <script>
                    alert('please do login first');
                    location.replace('login.php');
                    </script>
                ");

        $sql = "SELECT * FROM `shared_notes` WHERE `$p1`='$other_ID' AND `$p2`='$ID' AND `title`='$title';";

        $result  = mysqli_query( $conn , $sql );

        echo "<a href='show_shared_notes_to_user.php?$p1=$other_ID'>Back</a>";
    }

    if( !$result )
    die("
            <script>
            alert('something is wrong please try again');
            location.replace('show_notes_to_user.php');
            </script>
        ");

    $row = mysqli_fetch_assoc( $result );
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        .title{
            border: solid black 2px;
        }
        .description{
            border: solide green 2px;
        }
    </style>
</head>
<body>

    <div class="title">
        <?php echo $row["title"]; ?>
    </div>

    <div class="description">
        <?php echo $row["description"]; ?>
    </div>
    
</body>
</html>