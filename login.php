<?php
        session_start();
        require_once "back_restrict.php";
        require_once "connection.php";

        // this have two uses 
        // 1.if user press logout button then we will redirict him to login.php page and here we will unset his id so he will be logouted
        // 2. Assume user already logged in now he don't take any action and simply press back key in his browesr then he will come to this page so it must be logout and for this servecie we can use this
        
        if( isset($_SESSION["ID"]) )
        {
                echo "
                        <script>
                        alert('You are logouted');
                        </script>";
                        
                  unset( $_SESSION['ID'] );
        }
    

    if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        $email = $_POST["email"];
        
        $password = $_POST["password"];

        $sql = "SELECT * FROM `User_Details` WHERE  `email_id` = '$email' ";

        $result = mysqli_query( $conn , $sql );

        $row = mysqli_fetch_assoc( $result );
        
                                //if uesr give wrong emil id then
        
        if( !$row )
            die( "  <script>
                    alert('You have not an account Please sign up first');
                    location.replace('index.php');
                    </script>"
                );
        
        $hash = $row['password'];        

        if( password_verify( $password , $hash ) )
        {

            $_SESSION['ID'] = $row['ID'];
            
            echo "  <script>
                    location.replace('user_home_page.php');
                    </script>";
        }

        else
            echo "  <script>
                    alert('please give true password');
                    </script>";                  
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="block">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <!-- email address -->
        <input type="email" name="email" placeholder="give your email address" class="data"  required>

                    <!-- password -->
         <input type="password" placeholder="Give Your Password" class="data" name="password">         

         <input type="submit" id="btn" value="Let's Go">
         

        </form>
        
        <!-- if user forgot his password then -->
                
    <a href="forgot_pass.php">Forgot Password</a>


        
    </div>
</body>
</html>