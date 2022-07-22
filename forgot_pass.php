<?php

    session_start();

    require_once "connection.php";


    if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];
        
        $sql = "SELECT * FROM `User_Details` WHERE `full_name`='$full_name' AND `user_name`='$user_name' AND `email_id`='$email' ";

        $result = mysqli_query( $conn , $sql );

        $row = mysqli_fetch_assoc( $result );

                                                    // I put here ID1 as name so that it will not match with  login session's ID key
        $_SESSION['ID1'] = $row['ID'];

        if( !$result )
            echo "  <script>
                    alert('Please give true details');
                    location.replace('forgot_pass.php');
                    </script>";
        else
            echo "  <script>
                    alert('Give New Password');
                    location.replace('change_pass.php');
                    </script>";

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>

        <input type="email" placeholder="Email Address" name="email" required>

        <input type="text" placeholder="Full Namw" name="full_name" required>

        <input type="text" placeholder="User Name" name="user_name" required>

        <input type="submit" value="Go!!">

    </form>
</body>
</html>