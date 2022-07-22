<?php

    require_once "notes_actionCRUD.php";
    
                                          //BUG if we reload then .......

    $title_error = $description_error = "";
    $title = $description = "";

    if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
                // check title is valid or not
        $title = $_POST["title"];
        $title = trim($title);
        if( empty($title) )
            $title_error = "Please give title";

        else
        {
                        // checking wether a title is unique or not
            $sql = "SELECT * FROM `Notes` WHERE `user_id`='$ID' AND `title`='$title'";
            $result = mysqli_query( $conn , $sql );            

            if( !$result )
                echo"<script>
                     alert(' some thing is wrong wekfbeku please try again');
                     location.replace('user_home_page.php');
                     </script>";

            $row = mysqli_fetch_assoc( $result );
            if($row)
                $title_error = "This title is already exist";

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
                
            $sql = "INSERT INTO `Notes` (`user_id`, `title`, `description`, `date`) VALUES ('$ID','$title','$description' , CURRENT_TIMESTAMP )";
            
            $result = mysqli_query( $conn , $sql );                
                
             unset( $_SERVER["REQUEST_METHOD"] ) ;


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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="user_home_page.css">
    <script type="text/javascript">
        function active() {
            let titlel = document.getElementById('title');

            if (titlel.value == 'Title') {
                titlel.value = '';
                titlel.placeholder = 'Title';
            }
        }
        function inactive() {
            let titlel = document.getElementById('title');

            if (titlel.value == '') {
                titlel.value = "Title";
                titlel.placeholder = '';
            }
        }
        function active_desc() {
            let descr = document.getElementById('desc');

            if (descr.value == 'Description') {
                descr.value = '';
                descr.placeholder = 'Description';
                descr.style.fontSize = '20px';
                descr.style.padding = '0%';
            }
        }
        function inactive_desc() {
            let descr = document.getElementById('desc');

            if (descr.value == '') {
                descr.value = "Description";
                descr.placeholder = '';
                descr.style.fontSize = '106px';
                descr.style.paddingTop = '13%';
            }

        }

    </script>
</head>

<body>
    <header>
        <a href="show_notes_to_user.php" id='show_notes'>show notes</a>
        <a href="user_account.php" id='account'>My Account</a>
        <!-- icon -->
    </header>
    <div class="block">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <input type="text" placeholder="" class="data" value="<?php if(isset($result)) if(!$result) echo $title; else echo'Title';else echo 'Title'; ?>" maxlength="20"
                title="maximum length of title is 20" id="title" autocomplete="off" onmousedown="active();"
                onblur="inactive();" name="title">
                <span><?php echo $title_error; ?></span>

            <textarea name="description" placeholder="" id="desc" autocomplete="off" onmousedown="active_desc();"
                onblur="inactive_desc();"><?php if( isset($result)) if(!$result) echo $description;else echo "Description";else echo "Description"; ?></textarea><span><?php echo $description_error; ?></span>

            <!-- < name="" id="" cols="30" rows="10"></textarea> -->
            <input type="submit" id='submit' class='btn' value="Add it into the notes">
            <input type="reset" id='reset' class='btn' value="clear">
        </form>
    </div>
        
    
    </form>


</body>

</html>