<?php

    require_once "notes_actionCRUD.php";

    if( !isset($_GET['flag']) && !isset($_SESSION['flag']) )
    {
        die("
                <script>
                alert('You are trying to derectly come here');
                location.replace('login.php');
                </script>
            ");
    }
    elseif( isset( $_GET['flag'] ) )
          $_SESSION['flag'] = $_GET['flag'];

        $flag = $_SESSION['flag'];   //insted of session we can also use use here input type hiddern or insed of hidden we can simply use text because id is alredy shown when we come to this page first time because at that time we use get method

    $request_error = "";

    if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        $request = $_POST['request'];
        $request = trim( $request );
        if( empty($request) )
            $request_error = "Please write error here";
        else
        {            
            $sql = "INSERT INTO `request` (`sno`, `FROM12`, `TO12`, `text`) VALUES (NULL, '$ID', '$flag', '$request');";

            $result = mysqli_query( $conn , $sql );

            echo "
                    <script>
                 ";

            if( !$result )
                echo"
                        alert('Somethig is heppening wrong please try again');
                    ";
            else
                echo "
                        alert('request sent sucessfully');
                     ";
             unset($_SESSION['flag']);
            echo "
                    location.replace('show_other_people.php');
                    </script>
                    ";
               
                    
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
                
    <a href="show_other_people.php">Back</a>
                
    <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="POST">

        <textarea name="request" placeholder="write here your request"></textarea>
        <span><?php echo $request_error; ?></span>

        <input type="submit" value="Go">

    </form>
</body>
</html>