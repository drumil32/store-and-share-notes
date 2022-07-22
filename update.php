<?php

    require_once "notes_actionCRUD.php";

    if( !isset( $_GET["note_id"] ) && !isset( $_POST["note_id"] ) )
        die("
                <script>
                alert('please do login first');
                location.replace('login.php');
                </script>
            ");

    $title_error = $description_error = "";
    $title = $description = "";
            
    if( isset($_GET['note_id']) )
        $note_id = $_GET['note_id'];    
    else
        $note_id = $_POST['note_id'];

    $sql = "SELECT * FROM `Notes` WHERE `note_id`='$note_id' ;";

    $result = mysqli_query( $conn , $sql );

    $row = mysqli_fetch_assoc($result);

    $old_title = $title = $row['title'];
    
    $description = $row["description"];


    if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
                // check title is valid or not
        $title = $_POST["title"];
        $title = trim($title);
        if( empty($title) )
            $title_error = "Please give title";

        else
        {        
        
            if( $title!=$old_title )
            {


                            // checking wether a title is unique or not
                $sql = "SELECT * FROM `Notes` WHERE `user_id`='$ID' AND `title`='$title';";
                $result = mysqli_query( $conn , $sql );

                if( !$result )
                    echo"<script>
                        alert(' some thing is wrong wekfbeku please try again');
                        location.replace('user_home_page.php');
                        </script>";

                $num_of_row = mysqli_num_rows($result);
                echo "<br>".$num_of_row;
                if($num_of_row)
                    $title_error = "This title is already exist";
                
            }

        }
        
                // check discription 
        $description = $_POST["description"];
        $description = trim( $description );
        if( empty($description) )
            $description_error = "Please give description";

        if( empty($title_error) && empty($description_error) )
        {
            $description = mysqli_real_escape_string( $conn , $description );
            $title = mysqli_real_escape_string( $conn , $title );                            

            $sql = "UPDATE `Notes` SET   `title`='$title' , `description`='$description' ,`date`=CURRENT_TIMESTAMP WHERE `note_id`='$note_id' ";

            $result = mysqli_query( $conn , $sql );
            
//            die( var_dump($result) );

            if( !$result )
                echo "<script>
                     alert(' some thing is wrong please try again');
                     </script>";
            else
                echo "<script>
                      alert('Note add sucessfully');
                      </script>";
                      
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>            
        
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <input type="text" name="title" maxlength="254" placeholder="Title" value="<?php echo $title; ?>">
        <span><?php echo $title_error; ?></span>

        <textarea name="description" placeholder="write you description" ><?php echo $description; ?></textarea>
        <span><?php echo $description_error; ?></span>

        <input type="hidden" name="note_id" value=' <?php echo $note_id; ?> '>

        <input type="submit" value="Update Notes">
    </form>
    <a href="show_notes_to_user.php">Back</a>
</body>
</html>