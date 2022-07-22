<?php

    session_start();

    require_once "connection.php";

    if( !isset($_SESSION['ID1']) && !isset($_SESSION['ID']) )
        echo "
                <script>
                alert('Please give email id and other needed informaion first');
                location.replace('forgot_pass.php');
                </script>
             ";
    if( !isset($_SESSION['ID1']) )
        $ID = $_SESSION["ID1"];
    else
        $ID = $_SESSION['ID'];


    if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
                    // primary password
        $primary_password = $_POST["primary_passsword"];
        $primary_password = trim( $primary_password );
        if( empty($primary_password) )
            $primary_password_error = "Please give primary password";
        
                // confirm password
        $confirm_password = $_POST["confirm_password"];
        $confirm_password = trim( $confirm_password );
        if( empty($confirm_password) )
            $confirm_password_error = "Please give confirm passwrod";
        elseif( strcmp($confirm_password , $primary_password) )
            $confirm_password_error = "Both password are missmatch";

        if( empty($primary_password_error) && empty($confirm_password_error) )
        {
            $options = [
                'cost' => 12,
            ];
    
            $str_password = password_hash( $primary_password , PASSWORD_BCRYPT, $options);

            $sql = "UPDATE `User_Details` SET `password`='$str_password' WHERE `ID`='$ID'";                   

            $result = mysqli_query( $conn , $sql );

            if( !$result )
                echo "
                        <script>
                        alert('somethnig is wrong please try again');
                        location.replace('change_pass.php');
                        </script>
                    ";
            else
            {
                unset($_SESSION['ID1']);
                echo "
                        <script>
                        alert('pasword change sucessfully now you can login');
                        location.replace('login.php');
                        </script>
                    ";
            }            
            
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method='POST'>

                                            <!-- primary passoword -->
        <input type="password" name="primary_passsword" style="width: 300px;" placeholder="Give Password in this format Abcd@123"    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters " placeholder="Abcde@123" minlength="8" maxlength="15">
        <span><?php echo $primary_password_error; ?></span><br>

                                    <!-- confirm password -->
        <input type="password" name="confirm_password" style="width: 300px;" placeholder="Give confirm Password in this format Abcd@123"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters " placeholder="Abcde@123" minlength="8" maxlength="15">
        <span><?php echo $confirm_password_error;?> </span><br>
        
        <input type="submit" value="Change">
        
    </form>    

</body>
</html>